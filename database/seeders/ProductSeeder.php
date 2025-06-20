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
            'name' => 'Paket Edukasi + Snack',
            'description' => 'Paket edukasi interaktif dengan berbagai aktivitas seru dan mendapatkan snack lezat sebagai pelengkap pengalaman.',
            'facility' => 'Tiket Masuk, Welcome Drink, Edukasi Smart Farming, Edukasi Smart Feeding, Snack Box, Free Benih, Guide/MC',
            'price' => 47500,
            'type' => 'rombongan',
            'min'=> 50,
            'image' => 'edukasi+snack.png',
        ]);
        Product::create([
            'name' => 'Paket Edukasi + Snack',
            'description' => 'Paket edukasi interaktif dengan berbagai aktivitas seru dan mendapatkan snack lezat sebagai pelengkap pengalaman.',
            'facility' => 'Tiket Masuk, Welcome Drink, Edukasi Smart Farming, Edukasi Smart Feeding, Snack Box, Free Benih, Guide/MC',
            'price' => 50000,
            'type' => 'perorangan',
            'image' => 'edukasi+snack.png',
        ]);
        Product::create([
            'name' => 'Paket Edukasi + Makanan',
            'description' => 'Paket edukasi interaktif yang dilengkapi dengan makanan lezat, memberikan pengalaman belajar dan kuliner yang menyenangkan di Arjuna Farm.',
            'facility' => 'Tiket Masuk, Welcome Drink, Edukasi Smart Farming, Edukasi Smart Feeding, Makan, Free Benih, Guide/MC, Free Stiker, Free 1 Paket Merchandise',
            'price' => 95000,
            'type' => 'perorangan',
            'image' => 'edukasi+makanan.png',
        ]);
        Product::create([
            'name' => 'Paket Edukasi + Makanan',
            'description' => 'Paket edukasi interaktif yang dilengkapi dengan makanan lezat, memberikan pengalaman belajar dan kuliner yang menyenangkan di Arjuna Farm.',
            'facility' => 'Tiket Masuk, Welcome Drink, Edukasi Smart Farming, Edukasi Smart Feeding, Makan, Free Benih, Guide/MC, Free Stiker, Free 1 Paket Merchandise',
            'price' => 85700,
            'type' => 'rombongan',
            'min' => 50,
            'image' => 'edukasi+makanan.png',
        ]);
        Product::create([
            'name' => 'Paket Umum',
            'description' => 'Paket lengkap untuk menikmati pengalaman edukasi di Arjuna Farm, mulai dari pembelajaran smart farming dan smart feeding, makan bersama, coffee break, hingga aktivitas memancing dan mendapatkan ikan segar, didampingi guide/MC serta dokumentasi kegiatan.',
            'facility' => 'Tiket Masuk, Welcome Drink, Edukasi Smart Farming, Edukasi Smart Feeding, Makan, Coffee Break, Guide/MC, Free Mancing 1 Jam + Ikan Nila 1Kg, Dokumentasi',
            'price' => 110000,
            'type' => 'perorangan',
            'image' => 'umum.png',
        ]);
        Product::create([
            'name' => 'Paket Umum',
            'description' => 'Paket lengkap untuk menikmati pengalaman edukasi di Arjuna Farm, mulai dari pembelajaran smart farming dan smart feeding, makan bersama, coffee break, hingga aktivitas memancing dan mendapatkan ikan segar, didampingi guide/MC serta dokumentasi kegiatan.',
            'facility' => 'Tiket Masuk, Welcome Drink, Edukasi Smart Farming, Edukasi Smart Feeding, Makan, Coffee Break, Guide/MC, Free Mancing 1 Jam + Ikan Nila 1Kg, Dokumentasi',
            'price' => 97500,
            'type' => 'rombongan',
            'min' => 50,
            'image' => 'umum.png',
        ]);
        Product::create([
            'name' => 'Paket Edufarm + Outbound',
            'description' => 'Paket Edufarm + Outbound menghadirkan pengalaman edukasi berkebun yang interaktif, dilengkapi dengan aktivitas outbound seru seperti flying fox, serta fasilitas lengkap mulai dari makan, coffee break, hingga dokumentasi kegiatan.',
            'facility' => 'Tiket Masuk, Welcome Drink, Edukasi Smart Farming, Edukasi Smart Feeding, Makan, Coffee Break, Free Benih, Guide/MC, Free Stiker, Free 1 Paket Merchandise, Dokumentasi/Photo, Outbound/Flying Fox',
            'price' => 115000,
            'type' => 'perorangan',
            'image' => 'outbound.png',
        ]);
        Product::create([
            'name' => 'Paket Edufarm + Outbound',
            'description' => 'Paket Edufarm + Outbound menghadirkan pengalaman edukasi berkebun yang interaktif, dilengkapi dengan aktivitas outbound seru seperti flying fox, serta fasilitas lengkap mulai dari makan, coffee break, hingga dokumentasi kegiatan.',
            'facility' => 'Tiket Masuk, Welcome Drink, Edukasi Smart Farming, Edukasi Smart Feeding, Makan, Coffee Break, Free Benih, Guide/MC, Free Stiker, Free 1 Paket Merchandise, Dokumentasi/Photo, Outbound/Flying Fox',
            'price' => 105000,
            'type' => 'rombongan',
            'min' => 50,
            'image' => 'outbound.png',
        ]);
    }
}
