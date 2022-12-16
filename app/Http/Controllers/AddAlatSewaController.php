<?php

namespace App\Http\Controllers;

use App\Models\AddAlatSewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddAlatSewaController extends Controller
{
    public function index()
    {
        $addalatsewa = AddAlatSewa::all();
        return $addalatsewa;
    }
    
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nama_alat'=> 'required',
            'alamat' => 'required',
            'kapasitas' => 'required',
            'nomor_pengurus' => 'required',
            'biaya_harian' => 'nullable',
            'biaya_mingguan' => 'nullable',
            'biaya_bulanan' => 'nullable',
            'biaya_tahunan' => 'nullable',
            'file_path' => 'nullable|mimes:jpeg,png,jpg,doc,docx,pdf|max:4048'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);       
    }
    $addalatsewa = AddAlatSewa::create($input);
    $addalatsewa->nama_alat = $request->nama_alat;
    $addalatsewa->alamat = $request->alamat;
    $addalatsewa->kapasitas = $request->kapasitas;
    $addalatsewa->nomor_pengurus = $request->nomor_pengurus;
    $addalatsewa->biaya_harian = $request->biaya_harian;
    $addalatsewa->biaya_mingguan = $request->biaya_mingguan;
    $addalatsewa->biaya_bulanan = $request->biaya_bulanan;
    $addalatsewa->biaya_tahunan = $request->biaya_tahunan;
    $addalatsewa->file_path = $request->file('file_path')->store('public/Alat Sewa Documents');
    
    return response()->json([
        "success" => true,
        "message" => "sewa alat created successfully.",
        "data" => $addalatsewa
    ]);
    }

    public function show($id)
    {
        $addalatsewa = AddAlatSewa::find($id);
        if (is_null($addalatsewa)) {
            return $this->sendError('sewa alat not found.');
        }
        return response()->json([
            "data" => $addalatsewa
        ]);
    }

    public function update(Request $request, AddAlatSewa $addalatsewa)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nama_alat'=> 'required',
            'alamat' => 'required',
            'kapasitas' => 'required',
            'nomor_pengurus' => 'required',
            'biaya_harian' => 'nullable',
            'biaya_mingguan' => 'nullable',
            'biaya_bulanan' => 'nullable',
            'biaya_tahunan' => 'nullable',
            'file_path' => 'nullable'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }
            $addalatsewa = AddAlatSewa::find($request->id);
            $addalatsewa->nama_alat = $request->nama_alat;
            $addalatsewa->alamat = $request->alamat;
            $addalatsewa->kapasitas = $request->kapasitas;
            $addalatsewa->nomor_pengurus = $request->nomor_pengurus;
            $addalatsewa->biaya_harian = $request->biaya_harian;
            $addalatsewa->biaya_mingguan = $request->biaya_mingguan;
            $addalatsewa->biaya_bulanan = $request->biaya_bulanan;
            $addalatsewa->biaya_tahunan = $request->biaya_tahunan;
            $addalatsewa->file_path = $request->file_path;
            $addalatsewa->save();

            return response()->json([
            "success" => true,
            "message" => "sewa alat updated successfully.",
            "data" => $addalatsewa
            ]);
        }


    public function destroy($id)
    {
        $addalatsewa = AddAlatSewa::findOrFail($id);

        $data = $addalatsewa->delete();
        
        if ($data){
            return response()->json([
                "success" => true,
                "message" => "sewa alat deleted successfully.",
            ]);
        }
    }
}
