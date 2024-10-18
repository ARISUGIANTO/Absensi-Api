<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\KelasResource;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        // get all post
        $kelas = Kelas::latest()->paginate(5);


        return new KelasResource(true, 'Kelas Siswa', $kelas);
    }
}
