<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
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
     * Memproses data laporan banjir (Method POST) dan menyimpannya ke database
     * menggunakan Laporan::create() sesuai ketentuan modul d.
     */
    public function submit(Request $request): View
    {
        // Validasi data input: nama pelapor, lokasi, tinggi genangan air, dan tanggal kejadian
        $validatedData = $request->validate([
            'nama_pelapor' => 'required|string|max:100',
            'lokasi' => 'required|string|max:200',
            'tinggi_genangan' => 'required_without:tinggi_air|nullable|numeric|min:1',
            'tinggi_air' => 'required_without:tinggi_genangan|nullable|numeric|min:1',
            'tanggal_kejadian' => 'nullable|date',
        ], [
            'nama_pelapor.required' => 'Nama pelapor wajib diisi.',
            'lokasi.required' => 'Lokasi kejadian (kecamatan/desa) wajib diisi.',
            'tinggi_genangan.required_without' => 'Tinggi genangan air wajib diisi.',
            'tinggi_air.required_without' => 'Tinggi genangan air wajib diisi.',
            'tinggi_genangan.numeric' => 'Tinggi genangan air harus berupa angka.',
            'tinggi_air.numeric' => 'Tinggi genangan air harus berupa angka.',
            'tinggi_genangan.min' => 'Tinggi genangan air minimal 1 cm.',
            'tinggi_air.min' => 'Tinggi genangan air minimal 1 cm.',
            'tanggal_kejadian.date' => 'Format tanggal kejadian tidak valid.',
        ]);

        $tinggi = $request->input('tinggi_genangan') ?? $request->input('tinggi_air') ?? 0;
        $tanggalKejadian = $request->input('tanggal_kejadian') ?? now()->toDateString();

        // Menyimpan data ke tabel laporan menggunakan Laporan::create()
        $laporan = Laporan::create([
            'nama_pelapor' => $validatedData['nama_pelapor'],
            'lokasi' => $validatedData['lokasi'],
            'tinggi_genangan' => (int) $tinggi,
            'tanggal_kejadian' => $tanggalKejadian,
        ]);

        // Simpan ke flash session agar halaman konfirmasi dapat menampilkan data yang baru dikirim
        session()->flash('laporan_terbaru_id', $laporan->id);
        session()->flash('laporan_terbaru', $laporan);

        return view('lapor_banjir.konfirmasi', [
            'laporan' => $laporan,
            'namaPelapor' => $laporan->nama_pelapor,
            'lokasi' => $laporan->lokasi,
            'tinggiAir' => $laporan->tinggi_genangan,
            'tinggiGenangan' => $laporan->tinggi_genangan,
            'tanggalKejadian' => $laporan->tanggal_kejadian,
        ]);
    }

    /**
     * Menampilkan halaman konfirmasi laporan.
     * Dapat diakses langsung melalui route GET.
     */
    public function konfirmasi(): View
    {
        $laporan = session('laporan_terbaru');

        if (! $laporan && session('laporan_terbaru_id')) {
            $laporan = Laporan::find(session('laporan_terbaru_id'));
        }

        // Jika diakses langsung tanpa submit, ambil data laporan terbaru dari database
        if (! $laporan) {
            $laporan = Laporan::latest()->first();
        }

        $namaPelapor = $laporan ? $laporan->nama_pelapor : 'Rafly Maulana';
        $lokasi = $laporan ? $laporan->lokasi : 'Desa Citeureup, Kecamatan Dayeuhkolot';
        $tinggiAir = $laporan ? $laporan->tinggi_genangan : 85;
        $tanggalKejadian = $laporan ? $laporan->tanggal_kejadian : now()->toDateString();

        return view('lapor_banjir.konfirmasi', [
            'laporan' => $laporan,
            'namaPelapor' => $namaPelapor,
            'lokasi' => $lokasi,
            'tinggiAir' => $tinggiAir,
            'tinggiGenangan' => $tinggiAir,
            'tanggalKejadian' => $tanggalKejadian,
        ]);
    }

    /**
     * Menampilkan halaman daftar laporan banjir.
     * Mengambil seluruh data dari database menggunakan Laporan::all() sesuai ketentuan e.
     */
    public function daftar(): View
    {
        // Mengambil data dari database menggunakan Laporan::all()
        $daftarLaporan = Laporan::all();

        return view('lapor_banjir.daftar', [
            'daftarLaporan' => $daftarLaporan,
        ]);
    }
}
