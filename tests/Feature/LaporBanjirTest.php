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
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('LaporBanjir');
        $response->assertSee('Formulir Lapor Kejadian Banjir');
    }

    /**
     * Test submit form method POST berhasil memproses data dan menampilkan halaman konfirmasi.
     */
    public function test_submit_form_lapor_menampilkan_konfirmasi(): void
    {
        $data = [
            'nama_pelapor' => 'Rafly Maulana',
            'lokasi' => 'Desa Citeureup, Kecamatan Dayeuhkolot',
            'tinggi_air' => '85',
        ];

        $response = $this->post('/lapor', $data);

        $response->assertStatus(200);
        $response->assertSee('Konfirmasi Laporan Banjir');
        $response->assertSee('Rafly Maulana');
        $response->assertSee('Desa Citeureup, Kecamatan Dayeuhkolot');
        $response->assertSee('85 cm');
    }

    /**
     * Test validasi error jika input kosong.
     */
    public function test_submit_form_gagal_jika_kosong(): void
    {
        $response = $this->post('/lapor', []);
        $response->assertSessionHasErrors(['nama_pelapor', 'lokasi', 'tinggi_air']);
    }
}
