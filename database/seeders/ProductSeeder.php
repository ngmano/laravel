<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productArr = [
            [
                'name' => 'Product 1',
                'uuid' => Str::orderedUuid(),
                'price' => 100,
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry'
            ],
            [
                'name' => 'Product 2',
                'price' => 200,
                'uuid' => Str::orderedUuid(),
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry'
            ],
            [
                'name' => 'Product 3',
                'price' => 300,
                'uuid' => Str::orderedUuid(),
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry'
            ],
            [
                'name' => 'Product 4',
                'price' => 400,
                'uuid' => Str::orderedUuid(),
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry'
            ]
        ];
        Product::insert($productArr);
    }
}
