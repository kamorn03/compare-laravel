<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Collections;

class CreateCategoryAndCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'rings']);
        Collections::create(['name' => 'Judaica-Jewelry','category_id' => 1]);
    }
}
