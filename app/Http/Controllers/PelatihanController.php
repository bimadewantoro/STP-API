<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

        $dokumen_pelatihan_url = Storage::url($pelatihan->dokumen_pelatihan_path);
        $gambar_pelatihan_url = Storage::url($pelatihan->gambar_pelatihan_path);

        $pelatihan->update([
            'dokumen_pelatihan_path' => $dokumen_pelatihan_url,
            'gambar_pelatihan_path' => $gambar_pelatihan_url,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Pelatihan berhasil ditambahkan',
            'data' => $pelatihan,
        ], 201);
    }

    public function show($id)
    {
        $pelatihan = Pelatihan::find($id);

        if (!$pelatihan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pelatihan tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $pelatihan,
        ], 200);
    }

    public function update(Request $request, $id)
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

        $pelatihan = Pelatihan::find($id);

        if (!$pelatihan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pelatihan tidak ditemukan',
            ], 404);
        }

        $pelatihan->update([
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

        $dokumen_pelatihan_url = Storage::url($pelatihan->dokumen_pelatihan_path);
        $gambar_pelatihan_url = Storage::url($pelatihan->gambar_pelatihan_path);

        $pelatihan->update([
            'dokumen_pelatihan_path' => $dokumen_pelatihan_url,
            'gambar_pelatihan_path' => $gambar_pelatihan_url,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Pelatihan berhasil diubah',
            'data' => $pelatihan,
        ], 200);
    }

    public function destroy($id)
    {
        $pelatihan = Pelatihan::find($id);

        if (!$pelatihan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pelatihan tidak ditemukan',
            ], 404);
        }

        $pelatihan->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Pelatihan berhasil dihapus',
        ], 200);
    }
}
