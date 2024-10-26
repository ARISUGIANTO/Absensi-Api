<?php

namespace App\Http\Controllers\Api;

use App\Models\Jadwal;
use App\Http\Resources\JadwalResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{
    public function index()
    {
        // Mengambil semua data jadwal
        $Jadwals = Jadwal::latest()->paginate(5);

        // Mengembalikan data jadwal sebagai resource
        return new JadwalResource(true, 'Jadwal Siswa', $Jadwals);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        // Mendefinisikan aturan validasi
        $validator = Validator::make($request->all(), [
            'Hari'             => 'required|string',
            'Jam'              => 'required|string|regex:/^\d{2}:\d{2}\s?WIB$/',
            'Kelas'            => 'required|string',
            'Mata_Pelajaran'   => 'required|string',
            'Ruang'            => 'required|string',  // Sesuai dengan perubahan ke string
            'Catatan'          => 'nullable|string',
        ]);

        // Memeriksa apakah validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Membuat jadwal baru
        $jadwal = Jadwal::create([
            'Hari'             => $request->Hari,
            'Jam'              => $request->Jam,
            'Kelas'            => $request->Kelas,
            'Mata_Pelajaran'   => $request->Mata_Pelajaran,
            'Ruang'            => $request->Ruang,
            'Catatan'          => $request->Catatan,
        ]);

        // Mengembalikan response
        return new JadwalResource(true, 'Data Jadwal Berhasil Ditambahkan!', $jadwal);
    }
}
