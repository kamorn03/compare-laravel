<?php

namespace Database\Seeders;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Gold Plated Star',
            'slug' => 'Gold-Plated-Star',
            'details' => 'Gold Plated Star of David Pendant with Jerusalem Stone 18K',
            'price' => 69.00,
            'shipping_cost' => 10.99,
            'description' => 'Gold Plated Star of David Pendant with Jerusalem Stone 18K',
            'category_id' => 1,
            'collection_id' => 1,
            'image_path' => 'jewel-product-1.png'
        ]);

        Product::create([
            'name' => 'Star Of David Pendant with S Blue Opal Stripes',
            'slug' => 'Star-Of-David',
            'details' => 'Star Of David Pendant with S Blue Opal Stripes',
            'price' => 1499.99,
            'shipping_cost' => 19.99,
            'description' => 'Star Of David Pendant with S Blue Opal Stripes',
            'category_id' => 1,
            'collection_id' => 1,
            'image_path' => 'jewel-product-2.png'
        ]);

        Product::create([
            'name' => 'Sterling Silver Seashell Ring with Blue Opal and White CZ',
            'slug' => 'Sterling-Silver',
            'details' => 'Sterling Silver Seashell Ring with Blue Opal and White CZ',
            'price' => 649.99,
            'shipping_cost' => 14.99,
            'description' => 'Sterling Silver Seashell Ring with Blue Opal and White CZ',
            'category_id' => 1,
            'collection_id' => 2,
            'image_path' => 'jewel-product-3.png'
        ]);

        Product::create([
            'name' => '18K Gold Plated Sea Life Bangle - Whale TailDesign',
            'slug' => '18K-Gold-Plated',
            'details' => '18K Gold Plated Sea Life Bangle - Whale TailDesign',
            'price' => 8.99,
            'shipping_cost' => 1.89,
            'description' => '18K Gold Plated Sea Life Bangle - Whale TailDesign',
            'category_id' => 1,
            'collection_id' => 3,
            'image_path' => 'jewel-product-4.png'
        ]);

        Product::create([
            'name' => 'Round Silver Pendant with Name Engraved and Birthstone',
            'slug' => 'Round-Silver',
            'details' => 'Round Silver Pendant with Name Engraved and Birthstone',
            'price' => 41.99,
            'shipping_cost' => 12.59,
            'description' => 'Round Silver Pendant with Name Engraved and Birthstone',
            'category_id' => 1,
            'collection_id' => 4,
            'image_path' => 'jewel-product-5.png'
        ]);

        Product::create([
            'name' => 'I am my Beloved and my beloved is I- Jerusalem Stone Pendant',
            'slug' => 'I-am-my-Beloved',
            'details' => 'I am my Beloved and my beloved is I- Jerusalem Stone Pendant',
            'price' => 144.99,
            'shipping_cost' => 13.39,
            'description' => 'I am my Beloved and my beloved is I- Jerusalem Stone Pendant',
            'category_id' => 1,
            'collection_id' => 5,
            'image_path' => 'jewel-product-6.png'
        ]);

        Product::create([
            'name' => 'Gold plated Chain Bracelet with 8 Round Roman Glass',
            'slug' => 'Gold-plated-Chain-Bracelet',
            'details' => 'Gold plated Chain Bracelet with 8 Round Roman Glass',
            'price' => 148.99,
            'shipping_cost' => 6.79,
            'description' => 'Gold plated Chain Bracelet with 8 Round Roman Glass',
            'category_id' => 1,
            'collection_id' => 2,
            'image_path' => 'jewel-product-7.png'
        ]);
    }
}
