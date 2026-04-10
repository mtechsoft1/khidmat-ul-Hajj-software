<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DefaultCategorySeeder extends Seeder
{
    /**
     * Seed the application's predefined invoice categories.
     */
    public function run(): void
    {
        foreach (Category::defaultCategories() as $categoryName) {
            Category::firstOrCreate(['name' => $categoryName]);
        }
    }
}
