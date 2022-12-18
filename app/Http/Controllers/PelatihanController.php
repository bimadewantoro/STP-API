<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Storage;
>>>>>>> master
use Illuminate\Support\Facades\Validator;

class PelatihanController extends Controller
{
<<<<<<< HEAD
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelatihan = Pelatihan::all();
        return $pelatihan;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
=======
    public function index()
    {
        $pelatihans = Pelatihan::all();
        return $pelatihans;
    }

>>>>>>> master
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul_pelatihan' => 'required',
            'deskripsi' => 'required',
            'pembicara' => 'required',
            'kapasitas' => 'required',
            'biaya' => 'required',
<<<<<<< HEAD
            'hari' => 'required',
            'jam' => 'required',
            'dokumen_pendukung' => 'required',
=======
            'hari' => 'nullable',
            'jam' => 'nullable',
            'dokumen_pelatihan_path' => 'nullable',
            'gambar_pelatihan_path' => 'nullable',
>>>>>>> master
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
<<<<<<< HEAD
            'dokumen_pendukung' => $request->dokumen_pendukung,
=======
            'dokumen_pelatihan_path' => $request->file('dokumen_pelatihan_path')->store('public/dokumen_pelatihan'),
            'gambar_pelatihan_path' => $request->file('gambar_pelatihan_path')->store('public/gambar_pelatihan'),
        ]);

        $dokumen_pelatihan_url = Storage::url($pelatihan->dokumen_pelatihan_path);
        $gambar_pelatihan_url = Storage::url($pelatihan->gambar_pelatihan_path);

        $pelatihan->update([
            'dokumen_pelatihan_path' => $dokumen_pelatihan_url,
            'gambar_pelatihan_path' => $gambar_pelatihan_url,
>>>>>>> master
        ]);

        return response()->json([
            'status' => 'success',
<<<<<<< HEAD
            'data' => $pelatihan,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CoWorkSpace  $coWorkSpace
     * @return \Illuminate\Http\Response
     */
=======
            'message' => 'Pelatihan berhasil ditambahkan',
            'data' => $pelatihan,
        ], 201);
    }

>>>>>>> master
    public function show($id)
    {
        $pelatihan = Pelatihan::find($id);

<<<<<<< HEAD
=======
        if (!$pelatihan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pelatihan tidak ditemukan',
            ], 404);
        }

>>>>>>> master
        return response()->json([
            'status' => 'success',
            'data' => $pelatihan,
        ], 200);
<<<<<<< HEAD

        if (!$pelatihan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan',
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CoWorkSpace  $coWorkSpace
     * @return \Illuminate\Http\Response
     */
    public function edit(Pelatihan $pelatihan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CoWorkSpace  $coWorkSpace
     * @return \Illuminate\Http\Response
     */
=======
    }

>>>>>>> master
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'judul_pelatihan' => 'required',
            'deskripsi' => 'required',
            'pembicara' => 'required',
            'kapasitas' => 'required',
            'biaya' => 'required',
<<<<<<< HEAD
            'hari' => 'required',
            'jam' => 'required',
            'dokumen_pendukung' => 'required',
=======
            'hari' => 'nullable',
            'jam' => 'nullable',
            'dokumen_pelatihan_path' => 'nullable',
            'gambar_pelatihan_path' => 'nullable',
>>>>>>> master
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $pelatihan = Pelatihan::find($id);

<<<<<<< HEAD
=======
        if (!$pelatihan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pelatihan tidak ditemukan',
            ], 404);
        }

>>>>>>> master
        $pelatihan->update([
            'judul_pelatihan' => $request->judul_pelatihan,
            'deskripsi' => $request->deskripsi,
            'pembicara' => $request->pembicara,
            'kapasitas' => $request->kapasitas,
            'biaya' => $request->biaya,
            'hari' => $request->hari,
            'jam' => $request->jam,
<<<<<<< HEAD
            'dokumen_pendukung' => $request->dokumen_pendukung,
=======
            'dokumen_pelatihan_path' => $request->file('dokumen_pelatihan_path')->store('public/dokumen_pelatihan'),
            'gambar_pelatihan_path' => $request->file('gambar_pelatihan_path')->store('public/gambar_pelatihan'),
        ]);

        $dokumen_pelatihan_url = Storage::url($pelatihan->dokumen_pelatihan_path);
        $gambar_pelatihan_url = Storage::url($pelatihan->gambar_pelatihan_path);

        $pelatihan->update([
            'dokumen_pelatihan_path' => $dokumen_pelatihan_url,
            'gambar_pelatihan_path' => $gambar_pelatihan_url,
>>>>>>> master
        ]);

        return response()->json([
            'status' => 'success',
<<<<<<< HEAD
=======
            'message' => 'Pelatihan berhasil diubah',
>>>>>>> master
            'data' => $pelatihan,
        ], 200);
    }

<<<<<<< HEAD
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CoWorkSpace  $coWorkSpace
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pelatihan = Pelatihan::find($id);
=======
    public function destroy($id)
    {
        $pelatihan = Pelatihan::find($id);

        if (!$pelatihan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pelatihan tidak ditemukan',
            ], 404);
        }

>>>>>>> master
        $pelatihan->delete();

        return response()->json([
            'status' => 'success',
<<<<<<< HEAD
            'message' => 'Pelatihan deleted',
=======
            'message' => 'Pelatihan berhasil dihapus',
>>>>>>> master
        ], 200);
    }
}
