<?php

namespace Tests\Feature;

use Tests\TestCase;

class LaporBanjirTest extends TestCase
{
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
     * Test submit form method POST berhasil memproses data dan menampilkan halaman konfirmasi beserta alert.
     */
    public function test_submit_form_lapor_menampilkan_konfirmasi(): void
    {
        $data = [
            'nama_pelapor' => 'Rafly Maulana',
            'lokasi' => 'Desa Citeureup, Kecamatan Dayeuhkolot',
            'tinggi_air' => '85',
        ];

        $response = $this->post(route('lapor.submit'), $data);

        $response->assertStatus(200);
        $response->assertSee('Konfirmasi Laporan Banjir');
        $response->assertSee('Laporan Berhasil Dikirim!');
        $response->assertSee('Rafly Maulana');
        $response->assertSee('Desa Citeureup, Kecamatan Dayeuhkolot');
        $response->assertSee('85 cm');
        $response->assertSee('Awas');
    }

    /**
     * Test halaman konfirmasi dapat diakses melalui route GET.
     */
    public function test_halaman_konfirmasi_dapat_diakses_via_get(): void
    {
        $response = $this->get(route('lapor.konfirmasi'));
        $response->assertStatus(200);
        $response->assertSee('Konfirmasi Laporan Banjir');
        $response->assertSee('Laporan Berhasil Dikirim!');
    }

    /**
     * Test halaman daftar laporan memuat contoh data laporan dan status genangan (Waspada, Siaga, Awas).
     */
    public function test_halaman_daftar_laporan_memuat_data_dan_status(): void
    {
        $response = $this->get(route('lapor.daftar'));
        $response->assertStatus(200);
        $response->assertSee('Daftar Laporan Banjir Terkini');
        $response->assertSee('Waspada');
        $response->assertSee('Siaga');
        $response->assertSee('Awas');
        $response->assertSee('Dayeuhkolot');
    }

    /**
     * Test validasi error jika input kosong.
     */
    public function test_submit_form_gagal_jika_kosong(): void
    {
        $response = $this->post(route('lapor.submit'), []);
        $response->assertSessionHasErrors(['nama_pelapor', 'lokasi', 'tinggi_air']);
    }
}
