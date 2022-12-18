<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use App\Models\RegistrasiPelatihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegistrasiPelatihanController extends Controller
{
    public function index()
    {
        $registrasiPelatihan = RegistrasiPelatihan::all();
        return $registrasiPelatihan;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pelatihan_id' => 'required',
            'profile_talent_id' => 'required',
            'status' => 'required',
            'bukti_pembayaran_path' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $registrasiPelatihan = RegistrasiPelatihan::create([
            'pelatihan_id' => $request->pelatihan_id,
            'profile_talent_id' => $request->profile_talent_id,
            'status' => $request->status,
            'bukti_pembayaran_path' => $request->bukti_pembayaran_path,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $registrasiPelatihan,
        ]);
    }
}
