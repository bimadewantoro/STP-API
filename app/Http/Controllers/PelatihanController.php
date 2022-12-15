<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PelatihanController extends Controller
{
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul_pelatihan' => 'required',
            'deskripsi' => 'required',
            'pembicara' => 'required',
            'kapasitas' => 'required',
            'biaya' => 'required',
            'hari' => 'required',
            'jam' => 'required',
            'dokumen_pendukung' => 'required',
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
            'dokumen_pendukung' => $request->dokumen_pendukung,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $pelatihan,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CoWorkSpace  $coWorkSpace
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pelatihan = Pelatihan::find($id);

        return response()->json([
            'status' => 'success',
            'data' => $pelatihan,
        ], 200);

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
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'judul_pelatihan' => 'required',
            'deskripsi' => 'required',
            'pembicara' => 'required',
            'kapasitas' => 'required',
            'biaya' => 'required',
            'hari' => 'required',
            'jam' => 'required',
            'dokumen_pendukung' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $pelatihan = Pelatihan::find($id);

        $pelatihan->update([
            'judul_pelatihan' => $request->judul_pelatihan,
            'deskripsi' => $request->deskripsi,
            'pembicara' => $request->pembicara,
            'kapasitas' => $request->kapasitas,
            'biaya' => $request->biaya,
            'hari' => $request->hari,
            'jam' => $request->jam,
            'dokumen_pendukung' => $request->dokumen_pendukung,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $pelatihan,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CoWorkSpace  $coWorkSpace
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pelatihan = Pelatihan::find($id);
        $pelatihan->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Pelatihan deleted',
        ], 200);
    }
}
