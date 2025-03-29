<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Laundry Kilat',
                'description' => 'Layanan cuci cepat dengan estimasi waktu 3 jam. Cocok untuk pakaian yang tidak terlalu kotor.',
                'price' => 15000,
            ],
            [
                'name' => 'Laundry Biasa',
                'description' => 'Layanan cuci standar dengan estimasi waktu 24 jam. Cocok untuk pakaian sehari-hari.',
                'price' => 10000,
            ],
            [
                'name' => 'Laundry Berat',
                'description' => 'Layanan cuci khusus untuk pakaian yang sangat kotor atau memerlukan perawatan khusus. Estimasi waktu 48 jam.',
                'price' => 20000,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
