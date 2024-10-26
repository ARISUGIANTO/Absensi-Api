<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\KelasResource;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    public function index()
    {
        // get all post
        $kelas = Kelas::latest()->paginate(5);


        return new KelasResource(true, 'Kelas Siswa', $kelas);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'NISN'      => 'required|integer',
            'Nama'      => 'required|string',
            'Kelas'     => 'required|string',
            'Jurusan'   => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 442);
        }
        $kelas = Kelas::create([
            'NISN'      => $request->NISN,
            'Nama'      => $request->Nama,
            'Kelas'      => $request->Kelas,
            'Jurusan'      => $request->Jurusan,
        ]);

        return new KelasResource(True, 'Kelas Berhasil ditambahkan!', $kelas);
    }
}
