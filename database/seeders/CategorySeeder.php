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
        Category::create([
            'name' => 'Redes',
            'department_id' => 21
        ]);

        Category::create([
            'name' => 'Soporte Técnico',
            'department_id' => 21
        ]);

        Category::create([
            'name' => 'Coordinación',
            'department_id' => 21
        ]);

        Category::create([
            'name' => 'Desarrollo Web',
            'department_id' => 21
        ]);
    }
}
