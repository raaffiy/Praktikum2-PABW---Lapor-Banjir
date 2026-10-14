<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model ini.
     *
     * @var string
     */
    protected $table = 'laporan';

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_pelapor',
        'lokasi',
        'tinggi_genangan',
        'tanggal_kejadian',
    ];

    /**
     * Casting tipe data atribut.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tinggi_genangan' => 'integer',
            'tanggal_kejadian' => 'date:Y-m-d',
        ];
    }

    /**
     * Accessor untuk atribut tinggi_air agar kompatibel dengan view yang menggunakan nama lama.
     */
    public function getTinggiAirAttribute(): int
    {
        return (int) $this->tinggi_genangan;
    }
}
