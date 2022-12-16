<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;

class PelatihanController extends Controller
{
    public function index()
    {
        $pelatihans = Pelatihan::all();
        return $pelatihans;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul_pelatihan' => 'required',
            'deskripsi' => 'required',
            'pembicara' => 'required',
            'kapasitas' => 'required',
            'biaya' => 'required',
            'hari' => 'nullable',
            'jam' => 'nullable',
            'dokumen_pelatihan_path' => 'nullable',
            'gambar_pelatihan_path' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $pelatihan = Pelatihan::create([
            'judul_pelatihan' => $request->judul_pelatihan,
            'deskripsi' => $request->deskripsi,
            'pembicara' => $request->pembicara,
            'kapasitas' => $request->kapasitas,
            'biaya' => $request->biaya,
            'hari' => $request->hari,
            'jam' => $request->jam,
            'dokumen_pelatihan_path' => $request->file('dokumen_pelatihan_path')->store('public/dokumen_pelatihan'),
            'gambar_pelatihan_path' => $request->file('gambar_pelatihan_path')->store('public/gambar_pelatihan'),
        ]);
    }
}
