<?php

namespace App\Http\Controllers;

use App\Models\AddAlatSewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            'no_seri' => 'required',
            'merk' => 'required',
            'tahun_pembelian' => 'required',
            'pemilik' => 'required',
            'alamat' => 'required',
            'biaya_harian' => 'nullable',
            'biaya_mingguan' => 'nullable',
            'biaya_bulanan' => 'nullable',
            'biaya_tahunan' => 'nullable',
            'file_path' => 'nullable|mimes:jpeg,png,jpg,doc,docx,pdf|max:4048',
            'image_path_banner' => 'nullable|mimes:jpeg,png,jpg|max:4048'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);       
    }
    $addalatsewa = AddAlatSewa::create($input);
    $addalatsewa->nama_alat = $request->nama_alat;
    $addalatsewa->no_seri = $request->no_seri;
    $addalatsewa->merk = $request->merk;
    $addalatsewa->tahun_pembelian = $request->tahun_pembelian;
    $addalatsewa->pemilik = $request->pemilik;
    $addalatsewa->alamat = $request->alamat;
    $addalatsewa->biaya_harian = $request->biaya_harian;
    $addalatsewa->biaya_mingguan = $request->biaya_mingguan;
    $addalatsewa->biaya_bulanan = $request->biaya_bulanan;
    $addalatsewa->biaya_tahunan = $request->biaya_tahunan;
    $addalatsewa->file_path = $request->file('file_path')->store('/public/storage/Alat Sewa Documents');
    $addalatsewa->image_path_banner = $request->image('image_path_banner')->store('/public/storage/Alat_Sewa Images Banner');
    

    $alatsewa_file_path = Storage::url($addalatsewa->file_path);
    $alatsewa_image_path_banner = Storage::url($addalatsewa->image_path_banner);

    $addalatsewa->update([
        'file_path' => $alatsewa_file_path,
        'image_path_banner' => $alatsewa_image_path_banner,
    ]);
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
            'no_seri' => 'required',
            'merk' => 'required',
            'tahun_pembelian' => 'required',
            'pemilik' => 'required',
            'alamat' => 'required',
            'biaya_harian' => 'nullable',
            'biaya_mingguan' => 'nullable',
            'biaya_bulanan' => 'nullable',
            'biaya_tahunan' => 'nullable',
            'file_path' => 'nullable|mimes:jpeg,png,jpg,doc,docx,pdf|max:4048',
            'image_path_banner' => 'nullable|mimes:jpeg,png,jpg|max:4048'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }
            $addalatsewa = AddAlatSewa::find($request->id);
            $addalatsewa->nama_alat = $request->nama_alat;
            $addalatsewa->no_seri = $request->no_seri;
            $addalatsewa->merk = $request->merk;
            $addalatsewa->tahun_pembelian = $request->tahun_pembelian;
            $addalatsewa->pemilik = $request->pemilik;
            $addalatsewa->alamat = $request->alamat;
            $addalatsewa->biaya_harian = $request->biaya_harian;
            $addalatsewa->biaya_mingguan = $request->biaya_mingguan;
            $addalatsewa->biaya_bulanan = $request->biaya_bulanan;
            $addalatsewa->biaya_tahunan = $request->biaya_tahunan;
            $addalatsewa->file_path = $request->file('file_path')->store('/public/storage/Alat Sewa Documents');
            $addalatsewa->image_path_banner = $request->image('image_path_banner')->store('/public/storage/Alat_Sewa Images Banner');
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
