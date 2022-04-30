<?php

use Illuminate\Database\Seeder;
use App\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ProductCategory::class)->create([
            'id' => 1,
            'name' => 'インテリア',
        ]);
        factory(ProductCategory::class)->create([
            'id' => 2,
            'name' => '家電',
        ]);
        factory(ProductCategory::class)->create([
            'id' => 3,
            'name' => 'ファッション',
        ]);
        factory(ProductCategory::class)->create([
            'id' => 4,
            'name' => '美容',
        ]);
        factory(ProductCategory::class)->create([
            'id' => 5,
            'name' => '本・雑誌',
        ]);
    }
}
