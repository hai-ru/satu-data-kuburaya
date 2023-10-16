<?php

namespace Database\Seeders;

use App\Models\Testimoni;
use Illuminate\Database\Seeder;

class TestimoniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['nama' => 'Joni', 'email' => 'joni@gmail.com', 'rating' => '5', 'testimoni' => 'Keren, sudah ga bingung lagi cari data'],
            ['nama' => 'Andre Suhendri', 'email' => 'an.suhen@gmail.com', 'rating' => '4', 'testimoni' => 'Terimakasih sudah dipermudah dalam mencari data'],
            ['nama' => 'Mizan Fauzi', 'email' => 'mizan@yahoo.co.id', 'rating' => '5', 'testimoni' => 'Berguna sekali untuk tugas akhir kuliah'],
            ['nama' => 'Nurleli', 'email' => 'nerleliintan@gmail.com', 'rating' => '4', 'testimoni' => 'Mudah dalam mencari dan koleksi data sesuai dengan kebutuhan'],
        ];

        foreach ($data as $item) {
            Testimoni::create([
                'nama' => $item['nama'],
                'email' => $item['email'],
                'slug' => time(),
                'rating' => $item['rating'],
                'is_show' => true,
                'testimoni' => $item['testimoni'],
            ]);
        }
    }
}
