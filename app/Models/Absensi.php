<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{

    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'Nama',
        'Waktu_Absensi',
        'Foto_Absensi',
        'Status_Absensi',
        'Lokasi_Absensi'
    ];

    /**
     * foto
     *
     * @return Attribute
     */
    protected function foto(): Attribute
    {
        return Attribute::make(
            get: fn($foto_absensi) => url('/storage/foto/' . $foto_absensi),
        );
    }
}
