<?php

namespace Database\Seeders;

use App\Models\Bidang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $bidangs = [
            ['nama_bidang' => 'Pidana Umum', 'alias' => 'pidum'],
            ['nama_bidang' => 'Pidana Khusus', 'alias' => 'pidsus'],
            ['nama_bidang' => 'Barang Bukti', 'alias' => 'bb'],
            ['nama_bidang' => 'Pembinaan', 'alias' => 'pembinaan'],
        ];

        foreach ($bidangs as $bidang) {
            Bidang::create($bidang);
        }
    }
}
