<?php

namespace App\Http\Controllers;

use App\Models\Inkubasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class InkubasiController extends Controller
{
    public function index()
    {
        $inkubasi = Inkubasi::all();
        return $inkubasi;
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tentang' => 'required',
            'durasi' => 'required',
            'benefit' => 'required',
            'akses' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $inkubasi = Inkubasi::create([
            'tentang' => $request->tentang,
            'durasi' => $request->durasi,
            'benefit' => $request->benefit,
            'akses' => $request->akses,
        ]);


        return response()->json([
            'status' => 'success',
            'data' => $inkubasi,
        ], 200);
    }

   
    public function show($id)
    {
        $inkubasi = Inkubasi::find($id);

        return response()->json([
            'status' => 'success',
            'data' => $inkubasi,
        ], 200);

        if (!$inkubasi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan',
            ], 404);
        }
    }

   
    public function edit(Inkubasi $inkubasi)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tentang' => 'required',
            'durasi' => 'required',
            'benefit' => 'required',
            'akses' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $inkubasi = Inkubasi::find($id);

        $inkubasi->update([
            'tentang' => $request->tentang,
            'durasi' => $request->durasi,
            'benefit' => $request->benefit,
            'akses' => $request->akses,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $inkubasi,
        ], 200);
    }

   
    public function destroy($id)
    {
        $inkubasi = Inkubasi::find($id);
        $inkubasi->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Inkubasi deleted',
        ], 200);
    }
}

