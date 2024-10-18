<?php

namespace App\Http\Controllers\Api;

use App\Models\Absensi;

use App\Http\Resources\AbsensiResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        // get all post
        $absensi = Absensi::latest()->paginate(5);

        // return collection of posts as a resource
        return new AbsensiResource(true, 'Absensi Siswa', $absensi);
    }
}
