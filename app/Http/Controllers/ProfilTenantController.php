<?php

namespace App\Http\Controllers;

use App\Models\ProfilTenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfilTenantController extends Controller
{
    public function index()
    {
        $profilTenant = ProfilTenant::all();
        return $profilTenant;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_perusahaan' => 'required',
            'alamat_perusahaan' => 'required',
            'email_perusahaan' => 'required',
            'nomor_perusahaan' => 'required',
            'ketua_perusahaan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $profilTenant = ProfilTenant::create([
            'user_id' => auth()->user()->id,
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat_perusahaan' => $request->alamat_perusahaan,
            'email_perusahaan' => $request->email_perusahaan,
            'nomor_perusahaan' => $request->nomor_perusahaan,
            'ketua_perusahaan' => $request->ketua_perusahaan,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $profilTenant,
        ]);
    }

    public function show($id)
    {
        $profilTenant = ProfilTenant::find($id);

        if (!$profilTenant) {
            return response()->json([
                'status' => 'error',
                'message' => 'profil tenant not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $profilTenant,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_perusahaan' => 'required',
            'alamat_perusahaan' => 'required',
            'email_perusahaan' => 'required',
            'nomor_perusahaan' => 'required',
            'ketua_perusahaan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $profilTenant = ProfilTenant::find($id);

        if (!$profilTenant) {
            return response()->json([
                'status' => 'error',
                'message' => 'profil tenant not found',
            ], 404);
        }

        $profilTenant->update([
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat_perusahaan' => $request->alamat_perusahaan,
            'email_perusahaan' => $request->email_perusahaan,
            'nomor_perusahaan' => $request->nomor_perusahaan,
            'ketua_perusahaan' => $request->ketua_perusahaan,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $profilTenant,
        ]);
    }

    public function destroy($id)
    {
        $profilTenant = ProfilTenant::find($id);

        if (!$profilTenant) {
            return response()->json([
                'status' => 'error',
                'message' => 'profil tenant not found',
            ], 404);
        }

        $profilTenant->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'profil tenant deleted',
        ]);
    }
}
