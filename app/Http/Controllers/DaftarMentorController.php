<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DaftarMentor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DaftarMentorController extends Controller
{
    
    public function index()
    {
        $daftarMentor = DaftarMentor::all();
        return $daftarMentor;
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nama' => 'required|string|max:255',
            'sosmed' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }

        $daftarMentor = DaftarMentor::create($input);

        return response()->json([
            'status' => 'success',
            'data' => $daftarMentor,
        ], 200);
    }

   
    public function show($id)
    {
        $daftarMentor = DaftarMentor::find($id);

        return response()->json([
            'status' => 'success',
            'data' => $daftarMentor,
        ], 200);

        if (!$daftarMentor) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan',
            ], 404);
        }
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'sosmed' => 'required',
            'kategori' => 'required',
            'deskripsi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $daftarMentor = DaftarMentor::find($id);

        $daftarMentor->update([
            'nama' => $request->nama,
            'sosmed' => $request->sosmed,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $daftarMentor,
        ], 200);
    }

    
    public function destroy($id)
    {
        $daftarMentor = DaftarMentor::find($id);
        $daftarMentor->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'DaftarMentor deleted',
        ], 200);
    }
}
