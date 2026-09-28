<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporBanjirController extends Controller
{
    /**
     * Menampilkan halaman form pelaporan banjir.
     */
    public function index()
    {
        return view('lapor_banjir.index');
    }

    /**
     * Memproses data laporan banjir dan menampilkan halaman konfirmasi.
     * Data hanya diproses sementara oleh Controller tanpa disimpan ke database.
     */
    public function submit(Request $request)
    {
        // Validasi data input sesuai ketentuan (nama pelapor, lokasi, tinggi genangan air)
        $validatedData = $request->validate([
            'nama_pelapor' => 'required|string|max:100',
            'lokasi' => 'required|string|max:200',
            'tinggi_air' => 'required|numeric|min:1',
        ], [
            'nama_pelapor.required' => 'Nama pelapor wajib diisi.',
            'lokasi.required' => 'Lokasi kejadian (kecamatan/desa) wajib diisi.',
            'tinggi_air.required' => 'Tinggi genangan air wajib diisi.',
            'tinggi_air.numeric' => 'Tinggi genangan air harus berupa angka.',
        ]);

        // Mengirimkan kembali data ke view konfirmasi
        return view('lapor_banjir.konfirmasi', [
            'namaPelapor' => $validatedData['nama_pelapor'],
            'lokasi' => $validatedData['lokasi'],
            'tinggiAir' => $validatedData['tinggi_air'],
        ]);
    }
}
