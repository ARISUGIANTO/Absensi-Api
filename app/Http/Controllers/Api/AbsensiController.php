<?php

namespace App\Http\Controllers\Api;

use App\Models\Absensi;
use App\Http\Resources\AbsensiResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AbsensiController extends Controller
{
    public function index()
    {
        // Mengambil semua data absensi
        $absensi = Absensi::latest()->paginate(5);

        // Mengembalikan data absensi sebagai resource
        return new AbsensiResource(true, 'Absensi Siswa', $absensi);
    }

    /**
     * Store
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Mendefinisikan aturan validasi
        $validator = Validator::make($request->all(), [
            'id'                 => 'required|integer',
            'Nama'               => 'required|string',
            'Waktu_Absensi'      => 'required|string|regex:/^\d{2}:\d{2}\s?WIB$/',
            'Foto_Absensi'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'Status_Absensi'     => 'required|string',
            'Lokasi_Absensi'     => 'required|string',
        ]);

        // Memeriksa apakah validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Upload foto absensi
        $foto_absensi = $request->file('Foto_Absensi');
        $foto_path = $foto_absensi->storeAs('public/foto', $foto_absensi->hashName());

        // Membuat data absensi baru
        $absensi = Absensi::create([
            'id'                 => $request->id,
            'Nama'               => $request->Nama,
            'Waktu_Absensi'      => $request->Waktu_Absensi,
            'Foto_Absensi'       => $foto_absensi->hashName(), // Hanya menyimpan nama file
            'Status_Absensi'     => $request->Status_Absensi,
            'Lokasi_Absensi'     => $request->Lokasi_Absensi,
        ]);

        // Mengembalikan response dengan resource
        return new AbsensiResource(true, 'Data Absensi Berhasil Ditambahkan!', $absensi);
    }
}
