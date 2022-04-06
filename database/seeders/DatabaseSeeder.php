<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        Category::factory(5)->create()->each(function($category) {
            Product::factory(3, ['category_id' => $category->id])->create();
        });
        $this->call(OrderStatusSeeder::class);

    }
}
