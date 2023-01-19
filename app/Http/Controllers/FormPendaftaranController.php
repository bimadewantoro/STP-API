<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormPendaftaran;
use Illuminate\Support\Facades\Validator;

class FormPendaftaranController extends Controller
{
    public function index()
    {
        $formPendaftaran = FormPendaftaran::all();
        return $formPendaftaran;
    }
    
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'profil_bisnis' => 'required',
            'model_bisnis' => 'required',
            'deskripsi' => 'required',
            'strategi_marketing' => 'required',
            'profil_pemilik' => 'required',
            'jumlah_pegawai' => 'required',
            'projeksi_keuangan' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);       
    }
    $formPendaftaran = FormPendaftaran::create($input);
    return response()->json([
        "success" => true,
        "message" => "Pendaftaran submitted successfully.",
        "data" => $formPendaftaran
    ]);
    }

    public function show($id)
    {
        $formPendaftaran = FormPendaftaran::find($id);
        if (is_null($formPendaftaran)) {
            return $this->sendError('Pendaftaran not found.');
        }
        return response()->json([
            "data" => $formPendaftaran
        ]);
    }

    public function destroy($id)
    {
        $formPendaftaran = FormPendaftaran::findOrFail($id);

        $data = $formPendaftaran->delete();
        
        if ($data){
            return response()->json([
                "success" => true,
                "message" => "Pendaftaran deleted successfully.",
            ]);
        }
    }
}
