<?php

namespace Tests\Feature;

use App\Models\Laporan;
use Database\Seeders\LaporanSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LaporBanjirTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test halaman form lapor dapat diakses dengan response 200.
     */
    public function test_form_lapor_dapat_diakses(): void
    {
        $response = $this->get(route('lapor.index'));
        $response->assertStatus(200);
        $response->assertSee('LaporBanjir');
        $response->assertSee('Formulir Lapor Kejadian Banjir');
        $response->assertSee('Form Lapor');
        $response->assertSee('Daftar Laporan');
    }

    /**
     * Test submit form method POST berhasil menyimpan ke database (Laporan::create) dan menampilkan halaman konfirmasi.
     */
    public function test_submit_form_lapor_menyimpan_ke_database_dan_menampilkan_konfirmasi(): void
    {
        $data = [
            'nama_pelapor' => 'Rafly Maulana',
            'lokasi' => 'Desa Citeureup, Kecamatan Dayeuhkolot',
            'tinggi_genangan' => 85,
            'tanggal_kejadian' => '2026-10-14',
        ];

        $response = $this->post(route('lapor.submit'), $data);

        $response->assertStatus(200);
        $response->assertSee('Konfirmasi Laporan Banjir');
        $response->assertSee('Laporan Berhasil Dikirim!');
        $response->assertSee('Rafly Maulana');
        $response->assertSee('Desa Citeureup, Kecamatan Dayeuhkolot');
        $response->assertSee('85 cm');
        $response->assertSee('Awas');

        // Memastikan data tersimpan di tabel laporan
        $this->assertDatabaseHas('laporan', [
            'nama_pelapor' => 'Rafly Maulana',
            'lokasi' => 'Desa Citeureup, Kecamatan Dayeuhkolot',
            'tinggi_genangan' => 85,
        ]);
        $savedLaporan = Laporan::where('nama_pelapor', 'Rafly Maulana')->first();
        $this->assertNotNull($savedLaporan);
        $this->assertStringStartsWith('2026-10-14', (string) $savedLaporan->getRawOriginal('tanggal_kejadian'));
    }

    /**
     * Test halaman konfirmasi dapat diakses melalui route GET.
     */
    public function test_halaman_konfirmasi_dapat_diakses_via_get(): void
    {
        Laporan::create([
            'nama_pelapor' => 'Siti Nurhaliza',
            'lokasi' => 'Kecamatan Baleendah, Kab. Bandung',
            'tinggi_genangan' => 60,
            'tanggal_kejadian' => '2026-10-14',
        ]);

        $response = $this->get(route('lapor.konfirmasi'));
        $response->assertStatus(200);
        $response->assertSee('Konfirmasi Laporan Banjir');
        $response->assertSee('Laporan Berhasil Dikirim!');
    }

    /**
     * Test halaman daftar laporan memuat data dari database menggunakan Laporan::all() dan menampilkan status genangan.
     */
    public function test_halaman_daftar_laporan_memuat_data_dari_database_dan_status(): void
    {
        Laporan::create([
            'nama_pelapor' => 'Budi Hartono',
            'lokasi' => 'Kecamatan Bojongsoang, Kab. Bandung',
            'tinggi_genangan' => 25, // Waspada (< 30 cm)
            'tanggal_kejadian' => '2026-10-14',
        ]);

        Laporan::create([
            'nama_pelapor' => 'Siti Aminah',
            'lokasi' => 'Kecamatan Baleendah, Kab. Bandung',
            'tinggi_genangan' => 50, // Siaga (30-70 cm)
            'tanggal_kejadian' => '2026-10-14',
        ]);

        Laporan::create([
            'nama_pelapor' => 'Asep Sunandar',
            'lokasi' => 'Kecamatan Dayeuhkolot, Kab. Bandung',
            'tinggi_genangan' => 90, // Awas (> 70 cm)
            'tanggal_kejadian' => '2026-10-14',
        ]);

        $response = $this->get(route('lapor.daftar'));
        $response->assertStatus(200);
        $response->assertSee('Daftar Laporan Banjir Terkini');
        $response->assertSee('Waspada');
        $response->assertSee('Siaga');
        $response->assertSee('Awas');
        $response->assertSee('Dayeuhkolot');
        $response->assertSee('Baleendah');
        $response->assertSee('Bojongsoang');
    }

    /**
     * Test seeder LaporanSeeder menghasilkan minimal 15 data laporan.
     */
    public function test_laporan_seeder_berhasil_mengisi_minimal_15_data(): void
    {
        $this->seed(LaporanSeeder::class);

        $this->assertGreaterThanOrEqual(15, Laporan::count());
    }

    /**
     * Test validasi error jika input form kosong.
     */
    public function test_submit_form_gagal_jika_kosong(): void
    {
        $response = $this->post(route('lapor.submit'), []);
        $response->assertSessionHasErrors(['nama_pelapor', 'lokasi', 'tinggi_genangan']);
    }
}
