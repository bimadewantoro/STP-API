<?php

namespace App\Http\Controllers;

use App\Models\CoWorkSpace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CoWorkSpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coWorkSpaces = CoWorkSpace::all();
        return $coWorkSpaces;
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
            'nama_workspace' => 'required',
            'alamat' => 'required',
            'kapasitas' => 'required',
            'nomor_pengurus' => 'required',
            'biaya_harian' => 'required',
            'biaya_mingguan' => 'required',
            'biaya_bulanan' => 'required',
            'biaya_tahunan' => 'required',
            'fasilitas' => 'required',
            'jam_operasional_buka' => 'nullable',
            'jam_operasional_tutup' => 'nullable',
            'hari_operasional_buka' => 'required',
            'hari_operasional_tutup' => 'required',
            'dokumen_cowork_path' => 'nullable',
            'image_cowork_path' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $coWorkSpace = CoWorkSpace::create([
            'nama_workspace' => $request->nama_workspace,
            'alamat' => $request->alamat,
            'kapasitas' => $request->kapasitas,
            'nomor_pengurus' => $request->nomor_pengurus,
            'biaya_harian' => $request->biaya_harian,
            'biaya_mingguan' => $request->biaya_mingguan,
            'biaya_bulanan' => $request->biaya_bulanan,
            'biaya_tahunan' => $request->biaya_tahunan,
            'fasilitas' => $request->fasilitas,
            'jam_operasional_buka' => $request->jam_operasional_buka,
            'jam_operasional_tutup' => $request->jam_operasional_tutup,
            'hari_operasional_buka' => $request->hari_operasional_buka,
            'hari_operasional_tutup' => $request->hari_operasional_tutup,
            'dokumen_cowork_path' => $request->file('dokumen_cowork_path')->store('/public/storage/dokumen_cowork'),
            'image_cowork_path' => $request->file('image_cowork_path')->store('/public/storage/image_cowork'),
        ]);

        $dokumen_cowork_url = Storage::url($coWorkSpace->dokumen_cowork_path);
        $image_cowork_url = Storage::url($coWorkSpace->image_cowork_path);

        $coWorkSpace->update([
            'dokumen_cowork_path' => $dokumen_cowork_url,
            'image_cowork_path' => $image_cowork_url,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $coWorkSpace,
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
        $coWorkSpace = CoWorkSpace::find($id);

        return response()->json([
            'status' => 'success',
            'data' => $coWorkSpace,
        ], 200);

        if (!$coWorkSpace) {
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
    public function edit(CoWorkSpace $coWorkSpace)
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
            'nama_workspace' => 'required',
            'alamat' => 'required',
            'kapasitas' => 'required',
            'nomor_pengurus' => 'required',
            'biaya_harian' => 'required',
            'biaya_mingguan' => 'required',
            'biaya_bulanan' => 'required',
            'biaya_tahunan' => 'required',
            'fasilitas' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $coWorkSpace = CoWorkSpace::find($id);

        $coWorkSpace->update([
            'nama_workspace' => $request->nama_workspace,
            'alamat' => $request->alamat,
            'kapasitas' => $request->kapasitas,
            'nomor_pengurus' => $request->nomor_pengurus,
            'biaya_harian' => $request->biaya_harian,
            'biaya_mingguan' => $request->biaya_mingguan,
            'biaya_bulanan' => $request->biaya_bulanan,
            'biaya_tahunan' => $request->biaya_tahunan,
            'fasilitas' => $request->fasilitas,
            'jam_operasional_buka' => $request->jam_opeasional_buka,
            'jam_operasional_tutup' => $request->jam_opeasional_tutup,
            'hari_operasional_buka' => $request->hari_opeasional_buka,
            'hari_operasional_tutup' => $request->hari_opeasional_tutup,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $coWorkSpace,
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
        $coWorkSpace = CoWorkSpace::find($id);
        $coWorkSpace->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'CoWorkSpace deleted',
        ], 200);
    }
}
