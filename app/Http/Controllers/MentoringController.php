<?php

namespace App\Http\Controllers;

use App\Models\Mentoring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class MentoringController extends Controller
{
    public function index()
    {
        $mentoring = Mentoring::all();
        return $mentoring;
    }
    
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'judul_mentoring' => 'required',  
            'tanggal_mulai' => 'required',
            'durasi' => 'required',
            'judul_tugas' => 'required',  
            'deskripsi' => 'required',
            'image_path_banner' => 'required',  
            'deadline_pengumpulan' => 'required',
            'status_pengumpulan' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);       
    }
    $mentoring = Mentoring::create($input);
    return response()->json([
        "success" => true,
        "message" => "mentoring created successfully.",
        "data" => $mentoring
    ]);
    }

    public function show($id)
    {
        $mentoring = Mentoring::find($id);
        if (is_null($mentoring)) {
            return $this->sendError('mentoring not found.');
        }
        return response()->json([
            "data" => $mentoring
        ]);
    }

    public function update(Request $request, Mentoring $mentoring)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'judul_mentoring' => 'required',  
            'tanggal_mulai' => 'required',
            'durasi' => 'required',
            'judul_tugas' => 'required',  
            'deskripsi' => 'required',
            'image_path_banner' => 'required',  
            'deadline_pengumpulan' => 'required',
            'status_pengumpulan' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }   
            $mentoring = Mentoring::find($request->id);
            $mentoring->judul_mentoring = $request->judul_mentoring;
            $mentoring->tanggal_mulai = $request->tanggal_mulal;
            $mentoring->durasi = $request->durasi;
            $mentoring->judul_tugas = $request->judul_tugas;
            $mentoring->deskripsi = $request->deskripsi;
            $mentoring->image_path_banner = $request->image_path_banner;
            $mentoring->deadline_pengumpulan = $request->deadline_pengumpul;
            $mentoring->status_pengumpulan = $request->status_pengumpulan;

            return response()->json([
            "success" => true,
            "message" => "mentoring updated successfully.",
            "data" => $mentoring
            ]);
        }


    public function destroy($id)
    {
        $mentoring = Mentoring::findOrFail($id);

        $data = $mentoring->delete();
        
        if ($data){
            return response()->json([
                "success" => true,
                "message" => "mentoring deleted successfully.",
            ]);
        }
    }
}
