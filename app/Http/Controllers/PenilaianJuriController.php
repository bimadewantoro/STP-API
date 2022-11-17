<?php

namespace App\Http\Controllers;

use App\Models\PenilaianJuri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenilaianJuriController extends Controller
{
    public function index()
    {
        $penilaianjuri = PenilaianJuri::all();
        return $penilaianjuri;
    }
    
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'penerapan_di_masyarakat' => 'required',  
            'manfaat' => 'required',
            'keberlangsungan' => 'required',
            'presentasi_penyajian_produk' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);       
    }
    $penilaianjuri = PenilaianJuri::create($input);
    return response()->json([
        "success" => true,
        "message" => "penilaian submitted successfully.",
        "data" => $penilaianjuri
    ]);
    }

    public function show($id)
    {
        $penilaianjuri = PenilaianJuri::find($id);
        if (is_null($penilaianjuri)) {
            return $this->sendError('penilaian not found.');
        }
        return response()->json([
            "data" => $penilaianjuri
        ]);
    }

    public function update(Request $request, PenilaianJuri $penilaianjuri)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'penerapan_di_masyarakat' => 'required',  
            'manfaat' => 'required',
            'keberlangsungan' => 'required',
            'presentasi_penyajian_produk' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }   
            $penilaianjuri = PenilaianJuri::find($request->id);
            $penilaianjuri->penerapan_di_masyarakat = $request->penerapan_di_masyarakat;
            $penilaianjuri->manfaat = $request->manfaat;
            $penilaianjuri->keberlangsungan = $request->keberlangsungan;
            $penilaianjuri->presentasi_penyajian_produk = $request->presentasi_penyajian_produk;
            $penilaianjuri->save();

            return response()->json([
            "success" => true,
            "message" => "penilaian updated successfully.",
            "data" => $penilaianjuri
            ]);
        }


    public function destroy($id)
    {
        $penilaianjuri = PenilaianJuri::findOrFail($id);

        $data = $penilaianjuri->delete();
        
        if ($data){
            return response()->json([
                "success" => true,
                "message" => "penilaian deleted successfully.",
            ]);
        }
    }
}
