<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Features\Homepage\Models\HomeSection; // <-- Naya Namespace

class HomeSectionSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            ['section_key' => 'featured_products', 'title' => 'Featured Products', 'sort_order' => 1, 'limit' => 8, 'layout' => 'grid'],
            ['section_key' => 'banners_grid', 'title' => 'Best Selling Collections', 'sort_order' => 2, 'limit' => 3, 'layout' => 'grid'],
            ['section_key' => 'trending_products', 'title' => 'Trending Now', 'sort_order' => 3, 'limit' => 4, 'layout' => 'slider'],
            ['section_key' => 'testimonials', 'title' => 'What Our Customers Say', 'sort_order' => 4, 'limit' => 3, 'layout' => 'grid'],
        ];

        foreach ($sections as $section) {
            HomeSection::updateOrCreate(
                ['section_key' => $section['section_key']],
                $section
            );
        }
    }
}