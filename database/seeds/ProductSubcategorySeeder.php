<?php

use Illuminate\Database\Seeder;
use App\ProductSubcategory;

class ProductSubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ProductSubcategory::class)->create([
            'id' => 1,
            'product_category_id' => 1,
            'name' => '収納家具',
        ]);
        factory(ProductSubcategory::class)->create([
            'id' => 2,
            'product_category_id' => 1,
            'name' => '寝具',
        ]);
        factory(ProductSubcategory::class)->create([
            'id' => 3,
            'product_category_id' => 1,
            'name' => 'ソファ',
        ]);
        factory(ProductSubcategory::class)->create([
            'id' => 4,
            'product_category_id' => 1,
            'name' => 'ベッド',
        ]);
        factory(ProductSubcategory::class)->create([
            'id' => 5,
            'product_category_id' => 1,
            'name' => '照明',
        ]);
        factory(ProductSubcategory::class)->create([
            'id' => 6,
            'product_category_id' => 2,
            'name' => 'テレビ',
        ]);
        factory(ProductSubcategory::class)->create([
            'id' => 7,
            'product_category_id' => 2,
            'name' => '掃除機',
        ]);
        factory(ProductSubcategory::class)->create([
            'id' => 8,
            'product_category_id' => 2,
            'name' => 'エアコン',
        ]);
        factory(ProductSubcategory::class)->create([
            'id' => 9,
            'product_category_id' => 2,
            'name' => '冷蔵庫',
        ]);
        factory(ProductSubcategory::class)->create([
            'id' => 10,
            'product_category_id' => 2,
            'name' => 'レンジ',
        ]);
        factory(ProductSubcategory::class)->create([
            'id' => 11,
            'product_category_id' => 3,
            'name' => 'トップス',
        ]);
        factory(ProductSubcategory::class)->create([
            'id' => 12,
            'product_category_id' => 3,
            'name' => 'ボトム',
        ]);
        factory(ProductSubcategory::class)->create([
            'id' => 13,
            'product_category_id' => 3,
            'name' => 'ワンピース',
        ]);
        factory(ProductSubcategory::class)->create([
            'id' => 14,
            'product_category_id' => 3,
            'name' => 'ファッション小物',
        ]);
        factory(ProductSubcategory::class)->create([
            'id' => 15,
            'product_category_id' => 3,
            'name' => 'ドレス',
        ]);
        factory(ProductSubcategory::class)->create([
            'id' => 16,
            'product_category_id' => 4,
            'name' => 'ネイル',
        ]);
        factory(ProductSubcategory::class)->create([
            'id' => 17,
            'product_category_id' => 4,
            'name' => 'アロマ',
        ]);
        factory(ProductSubcategory::class)->create([
            'id' => 18,
            'product_category_id' => 4,
            'name' => 'スキンケア',
        ]);
        factory(ProductSubcategory::class)->create([
            'id' => 19,
            'product_category_id' => 4,
            'name' => '香水',
        ]);
        factory(ProductSubcategory::class)->create([
            'id' => 20,
            'product_category_id' => 4,
            'name' => 'メイク',
        ]);
        factory(ProductSubcategory::class)->create([
            'id' => 21,
            'product_category_id' => 5,
            'name' => '旅行',
        ]);
        factory(ProductSubcategory::class)->create([
            'id' => 22,
            'product_category_id' => 5,
            'name' => 'ホビー',
        ]);
        factory(ProductSubcategory::class)->create([
            'id' => 23,
            'product_category_id' => 5,
            'name' => '写真集',
        ]);
        factory(ProductSubcategory::class)->create([
            'id' => 24,
            'product_category_id' => 5,
            'name' => '小説',
        ]);
        factory(ProductSubcategory::class)->create([
            'id' => 25,
            'product_category_id' => 5,
            'name' => 'ライフスタイル',
        ]);
    }
}
