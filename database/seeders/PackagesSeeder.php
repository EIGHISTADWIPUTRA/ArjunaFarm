<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            [
                "name" => "Paket Edukasi Dasar",
                "description" => "Kunjungan singkat dengan pengenalan konsep Smart Farming berbasis IoT, melihat tanaman organik, dan menikmati satu minuman organik di Kafe Arjuna.",
                "type" => "personal",
                "price" => 25000.00,
                "discount_percentage" => 0.00,
                "min_participants" => 1,
                "image" => "basic-tour.jpg",
                "is_active" => true
            ],
            [
                "name" => "Paket Edukasi Lengkap",
                "description" => "Pengalaman lengkap termasuk tour Smart Farming, demonstrasi monitoring tanaman, makan siang dengan menu organik, dan aktivitas memetik sayuran untuk dibawa pulang.",
                "type" => "personal",
                "price" => 75000.00,
                "discount_percentage" => 0.00,
                "min_participants" => 1,
                "image" => "premium-exp.jpg",
                "is_active" => true
            ],
            [
                "name" => "Paket Sekolah Dasar",
                "description" => "Paket edukasi khusus untuk siswa sekolah dasar dengan aktivitas interaktif, pengenalan pertanian pintar, dan kegiatan outbound yang menyenangkan.",
                "type" => "rombongan",
                "price" => 50000.00,
                "discount_percentage" => 10.00,
                "min_participants" => 20,
                "image" => "elementary-school.jpg",
                "is_active" => true
            ],
            [
                "name" => "Paket Sekolah Menengah",
                "description" => "Paket edukasi untuk siswa SMP/SMA dengan fokus pada teknologi pertanian dan implementasi IoT, termasuk workshop singkat dan makan siang.",
                "type" => "rombongan",
                "price" => 60000.00,
                "discount_percentage" => 10.00,
                "min_participants" => 20,
                "image" => "high-school.jpg",
                "is_active" => true
            ],
            [
                "name" => "Paket Keluarga",
                "description" => "Pengalaman keluarga seru dengan akses ke semua area, termasuk 1x permainan Flying Fox, makan siang, dan aktivitas memetik sayuran.",
                "type" => "personal",
                "price" => 100000.00,
                "discount_percentage" => 5.00,
                "min_participants" => 3,
                "image" => "family-pack.jpg",
                "is_active" => true
            ]
        ];

        foreach ($packages as $package) {
            Package::create($package);
        }
    }
}
