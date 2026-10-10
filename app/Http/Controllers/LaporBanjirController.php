<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class LaporBanjirController extends Controller
{
    /**
     * Menampilkan halaman form pelaporan banjir.
     */
    public function index(): View
    {
        return view('lapor_banjir.index');
    }

    /**
     * Memproses data laporan banjir (Method POST) dan menampilkan halaman konfirmasi.
     * Karena prototipe tanpa database, data diproses langsung oleh Controller.
     */
    public function submit(Request $request): View
    {
        // Validasi data input: nama pelapor, lokasi, tinggi genangan air
        $validatedData = $request->validate([
            'nama_pelapor' => 'required|string|max:100',
            'lokasi' => 'required|string|max:200',
            'tinggi_air' => 'required|numeric|min:1',
        ], [
            'nama_pelapor.required' => 'Nama pelapor wajib diisi.',
            'lokasi.required' => 'Lokasi kejadian (kecamatan/desa) wajib diisi.',
            'tinggi_air.required' => 'Tinggi genangan air wajib diisi.',
            'tinggi_air.numeric' => 'Tinggi genangan air harus berupa angka.',
            'tinggi_air.min' => 'Tinggi genangan air minimal 1 cm.',
        ]);

        // Simpan ke session flash agar jika halaman konfirmasi di-refresh atau dibuka lewat route GET konfirmasi, data tetap tersedia
        session()->flash('laporan_terbaru', $validatedData);

        return view('lapor_banjir.konfirmasi', [
            'namaPelapor' => $validatedData['nama_pelapor'],
            'lokasi' => $validatedData['lokasi'],
            'tinggiAir' => $validatedData['tinggi_air'],
        ]);
    }

    /**
     * Menampilkan halaman konfirmasi laporan.
     * Dapat diakses langsung melalui route GET.
     */
    public function konfirmasi(): View
    {
        $laporan = session('laporan_terbaru');

        // Jika diakses langsung tanpa submit, sediakan data representatif contoh
        $namaPelapor = $laporan['nama_pelapor'] ?? 'Rafly Maulana';
        $lokasi = $laporan['lokasi'] ?? 'Desa Citeureup, Kecamatan Dayeuhkolot';
        $tinggiAir = $laporan['tinggi_air'] ?? 85;

        return view('lapor_banjir.konfirmasi', [
            'namaPelapor' => $namaPelapor,
            'lokasi' => $lokasi,
            'tinggiAir' => $tinggiAir,
        ]);
    }

    /**
     * Menampilkan halaman daftar laporan banjir yang memuat beberapa contoh laporan.
     * Data laporan ditulis dalam bentuk array pada Controller (tanpa database).
     */
    public function daftar(): View
    {
        // Contoh data laporan banjir dengan variasi tinggi air untuk menguji status:
        // < 30 cm = Waspada, 30-70 cm = Siaga, > 70 cm = Awas
        $daftarLaporan = [
            [
                'nama_pelapor' => 'Asep Sunandar',
                'lokasi' => 'Kp. Bojong Asih, Desa Dayeuhkolot, Kec. Dayeuhkolot',
                'tinggi_air' => 95,
                'waktu' => '10 menit yang lalu',
            ],
            [
                'nama_pelapor' => 'Siti Nurhaliza',
                'lokasi' => 'Kelurahan Andir, Kec. Baleendah',
                'tinggi_air' => 60,
                'waktu' => '25 menit yang lalu',
            ],
            [
                'nama_pelapor' => 'Budi Hartono',
                'lokasi' => 'Desa Tegalluar, Kec. Bojongsoang',
                'tinggi_air' => 20,
                'waktu' => '45 menit yang lalu',
            ],
            [
                'nama_pelapor' => 'Rina Wijaya',
                'lokasi' => 'Desa Cijagra, Kec. Paseh',
                'tinggi_air' => 120,
                'waktu' => '1 jam yang lalu',
            ],
            [
                'nama_pelapor' => 'Dedi Kurniawan',
                'lokasi' => 'Desa Kamasan, Kec. Banjaran',
                'tinggi_air' => 35,
                'waktu' => '2 jam yang lalu',
            ],
            [
                'nama_pelapor' => 'Hendro Prasetyo',
                'lokasi' => 'Desa Pananjung, Kec. Cangkuang',
                'tinggi_air' => 15,
                'waktu' => '3 jam yang lalu',
            ],
        ];

        return view('lapor_banjir.daftar', [
            'daftarLaporan' => $daftarLaporan,
        ]);
    }
}
