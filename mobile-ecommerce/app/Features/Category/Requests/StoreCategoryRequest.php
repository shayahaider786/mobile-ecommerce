<?php

namespace App\Features\Category\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;  // middleware 'admin' check kar raha hai pehle hi
    }

    public function rules(): array
    {
        $categoryId = $this->route('category')?->id;

        return [
            'name'        => 'required|string|max:255|unique:categories,name,' . $categoryId,
            'description' => 'nullable|string|max:1000',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active'   => 'boolean',
            'sort_order'  => 'nullable|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Category ka naam zaroori hai',
            'name.unique'   => 'Yeh category pehle se exist karti hai',
            'image.image'   => 'Sirf image file upload karo',
            'image.max'     => 'Image 2MB se choti honi chahiye',
        ];
    }
}