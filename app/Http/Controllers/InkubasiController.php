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
    
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'deskripsi' => 'required|string|max:255',
            'durasi' => 'required|integer|max:10',
            'benefit' => 'required|string|max:255',
            'akses' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);       
    }
    $inkubasi = Inkubasi::create($input);
    return response()->json([
        "success" => true,
        "message" => "inkubasi created successfully.",
        "data" => $inkubasi
    ]);
    }

    public function show($id)
    {
        $inkubasi = Inkubasi::find($id);
        if (is_null($inkubasi)) {
            return $this->sendError('inkubasi not found.');
        }
        return response()->json([
            "data" => $inkubasi
        ]);
    }


    public function update(Request $request, Inkubasi $inkubasi)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'deskripsi' => 'required|integer|max:10',
            'durasi' => 'required|string|max:150',
            'benefit' => 'required|string|max:255',
            'akses' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }
            $inkubasi = Inkubasi::find($request->id);
            $inkubasi->deskripsi = $request->deskripsi;
            $inkubasi->durasi = $request->durasi;
            $inkubasi->benefit = $request->benefit;
            $inkubasi->akses = $request->akses;
            $inkubasi->save();

            return response()->json([
            "success" => true,
            "message" => "proposal updated successfully.",
            "data" => $inkubasi
            ]);
        }


    public function destroy($id)
    {
        $inkubasi = Inkubasi::findOrFail($id);

        $data = $inkubasi->delete();
        
        if ($data){
            return response()->json([
                "success" => true,
                "message" => "inkubasi deleted successfully.",
            ]);
        }
    }
}

