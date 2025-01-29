<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //! Asignacion manual
        // $categories = [
        //     [
        //         'name' => 'Categoria 1',
        //         'slug' => 'categoria-1',
        //     ],
        //     [
        //         'name' => 'Categoria 2',
        //         'slug' => 'categoria-2',
        //     ],
        //     [
        //         'name' => 'Categoria 3',
        //         'slug' => 'categoria-3',
        //     ]
        // ];

        // foreach ($categories as $category) {
        //     Category::create($category);
        // }

        //! Asignacion factory
        Category::factory(10)->create();
    }
}
