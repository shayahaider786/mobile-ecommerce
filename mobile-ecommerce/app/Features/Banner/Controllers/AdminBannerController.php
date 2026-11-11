<?php

namespace App\Features\Banner\Controllers;

use App\Http\Controllers\Controller;
use App\Features\Banner\Models\Banner;
use App\Features\Banner\Services\BannerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AdminBannerController extends Controller
{
    public function __construct(private BannerService $service) {}

    public function index()
    {
        $banners = $this->service->getAllBanners();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'desktop_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:3072', // 3MB max
            'mobile_image'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'title'         => 'nullable|string|max:255',
            'subtitle'      => 'nullable|string|max:500',
            'button_name'   => 'nullable|string|max:50',
            'link'          => 'nullable|string|max:255',
            'sort_order'    => 'integer',
        ]);

        $data = $request->except(['desktop_image', 'mobile_image']);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('desktop_image')) {
            $data['desktop_image'] = $this->uploadImage($request->file('desktop_image'));
        }
        if ($request->hasFile('mobile_image')) {
            $data['mobile_image'] = $this->uploadImage($request->file('mobile_image'));
        }

        Banner::create($data);
        $this->service->clearCache();

        return redirect()->route('admin.banners.index')->with('success', 'Banner created successfully.');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'desktop_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'mobile_image'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except(['desktop_image', 'mobile_image']);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('desktop_image')) {
            $this->deleteImage($banner->desktop_image);
            $data['desktop_image'] = $this->uploadImage($request->file('desktop_image'));
        }
        if ($request->hasFile('mobile_image')) {
            $this->deleteImage($banner->mobile_image);
            $data['mobile_image'] = $this->uploadImage($request->file('mobile_image'));
        }

        $banner->update($data);
        $this->service->clearCache();

        return redirect()->route('admin.banners.index')->with('success', 'Banner updated.');
    }

    public function destroy(Banner $banner)
    {
        $this->deleteImage($banner->desktop_image);
        $this->deleteImage($banner->mobile_image);
        $banner->delete();
        $this->service->clearCache();

        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted.');
    }

    private function uploadImage($file)
    {
        $path = public_path('banners');
        if (!File::exists($path)) File::makeDirectory($path, 0755, true);

        $filename = time() . '_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
        $file->move($path, $filename);
        return $filename;
    }

    private function deleteImage($filename)
    {
        if ($filename && File::exists(public_path('banners/' . $filename))) {
            File::delete(public_path('banners/' . $filename));
        }
    }
}