<?php

namespace App\Http\Controllers;

use App\Models\MentoringPeserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MentoringPesertaController extends Controller
{
    public function index()
    {
        $mentoringPeserta = MentoringPeserta::all();
        return $mentoringPeserta;
    }
    
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nilai_penugasan' => 'required',
            'lampiran_path' => 'required',
            'tanggal_upload' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);       
    }
    $mentoringPeserta = MentoringPeserta::create($input);
    return response()->json([
        "success" => true,
        "message" => "mentoring peserta created successfully.",
        "data" => $mentoringPeserta
    ]);
    }

    public function show($id)
    {
        $mentoringPeserta = MentoringPeserta::find($id);
        if (is_null($mentoringPeserta)) {
            return $this->sendError('mentoring peserta not found.');
        }
        return response()->json([
            "data" => $mentoringPeserta
        ]);
    }

    public function update(Request $request, MentoringPeserta $mentoringPeserta)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nilai_penugasan' => 'required',
            'lampiran_path' => 'required',
            'tanggal_upload' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }
            $mentoringPeserta = MentoringPeserta::find($request->id);
            $mentoringPeserta->nilai_penugasan = $request->nilai_penugasan;
            $mentoringPeserta->lampiran_path = $request->lampiran_path;
            $mentoringPeserta->tanggal_upload = $request->tanggal_upload;
            

            return response()->json([
            "success" => true,
            "message" => "mentoring peserta updated successfully.",
            "data" => $mentoringPeserta
            ]);
        }


    public function destroy($id)
    {
        $mentoringPeserta = MentoringPeserta::findOrFail($id);

        $data = $mentoringPeserta->delete();
        
        if ($data){
            return response()->json([
                "success" => true,
                "message" => "mentoring peserta deleted successfully.",
            ]);
        }
    }
}
