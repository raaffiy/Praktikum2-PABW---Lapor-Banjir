<?php

namespace Database\Seeders;

use App\Models\Laporan;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menggunakan Faker dengan locale id_ID sesuai ketentuan modul f
        $faker = Faker::create('id_ID');

        // Daftar kecamatan di Kabupaten Bandung sesuai ketentuan
        $kecamatanBandung = [
            'Dayeuhkolot',
            'Baleendah',
            'Bojongsoang',
            'Rancaekek',
            'Majalaya',
            'Banjaran',
            'Ciparay',
            'Soreang',
            'Katapang',
            'Cileunyi',
            'Pameungpeuk',
            'Cicalengka',
            'Kutawaringin',
            'Margahayu',
            'Ibun',
        ];

        // Menghasilkan minimal 15 data dummy (dibuat 20 data agar status genangan lebih bervariasi)
        for ($i = 0; $i < 20; $i++) {
            $kecamatan = $faker->randomElement($kecamatanBandung);
            $lokasi = "Kecamatan {$kecamatan}, Kab. Bandung";

            // Tinggi genangan acak antara 10–150 cm
            // Tanggal kejadian acak dalam 1 bulan terakhir
            Laporan::create([
                'nama_pelapor' => $faker->name(),
                'lokasi' => $lokasi,
                'tinggi_genangan' => $faker->numberBetween(10, 150),
                'tanggal_kejadian' => $faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
            ]);
        }
    }
}
