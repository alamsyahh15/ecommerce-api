<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Category::create(["name" => "Computer"]);
        Category::create(["name" => "Buku"]);
        Category::create(["name" => "Sembako"]);
        Category::create(["name" => "Kaos"]);
        Category::create(["name" => "Baju"]);
        Category::create(["name" => "Baju Wanita"]);
        Category::create(["name" => "Jaket"]);
        Category::create(["name" => "Smartphone"]);
        Category::create(["name" => "TV"]);
        Category::create(["name" => "Sepatu"]);
    }
}
