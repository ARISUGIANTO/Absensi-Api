<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'Hari',
        'Jam',
        'Kelas',
        'Mata_Pelajaran',
        'Ruang',
        'Catatan'
    ];
}
