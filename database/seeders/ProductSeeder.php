<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Berkuda',
            'description' => 'Nikmati pengalaman berkuda mengelilingi padang rumput yang indah.',
            'facility' => '-',
            'price' => 75000,
            'image' => 'berkuda.jpg',
        ]);
        Product::create([
            'name' => 'Memetik Buah',
            'description' => 'Pengalaman memetik buah segar langsung dari kebun.',
            'facility' => '-',
            'price' => 50000,
            'image' => 'metik.jpg',
        ]);
        Product::create([
            'name' => 'Feeding Ternak',
            'description' => 'Berinteraksi dan memberi makan ternak dengan pendampingan.',
            'facility' => '-',
            'price' => 45000,
            'image' => 'feeding.jpg',
        ]);
    }
}
