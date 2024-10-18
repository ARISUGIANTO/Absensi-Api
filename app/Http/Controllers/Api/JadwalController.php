<?php

namespace App\Http\Controllers\Api;
// import model jadwal
use App\Models\Jadwal;

// import model resource JadwalResource
use App\Http\Resources\JadwalResource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        // get all post
        $Jadwals = jadwal::latest()->paginate(5);

        // return collection of posts as a resource
        return new JadwalResource(true, 'Jadwal Siswa', $Jadwals);
    }
}
