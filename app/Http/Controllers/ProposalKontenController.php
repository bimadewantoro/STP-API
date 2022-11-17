<?php

namespace App\Http\Controllers;

use App\Models\ProposalKonten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProposalKontenController extends Controller
{
    public function index()
    {
        $proposalkonten = ProposalKonten::all();
        return $proposalkonten;
    }
    
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'konten_judul' => 'required',  
            'konten_subjudul' => 'required',
            'konten_isi' => 'required|min:50',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);       
    }
    $proposalkonten = ProposalKonten::create($input);
    return response()->json([
        "success" => true,
        "message" => "konten created successfully.",
        "data" => $proposalkonten
    ]);
    }

    public function show($id)
    {
        $proposalkonten = ProposalKonten::find($id);
        if (is_null($proposalkonten)) {
            return $this->sendError('konten not found.');
        }
        return response()->json([
            "data" => $proposalkonten
        ]);
    }

    public function update(Request $request, ProposalKonten $proposalkonten)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'konten_judul' => 'required',
            'konten_subjudul' => 'required',
            'konten_isi' => 'required|min:50',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }   
            $proposalkonten = ProposalKonten::find($request->id);
            $proposalkonten->konten_judul = $request->konten_judul;
            $proposalkonten->konten_subjudul = $request->konten_subjudul;
            $proposalkonten->konten_isi = $request->konten_isi;
            $proposalkonten->save();

            return response()->json([
            "success" => true,
            "message" => "konten updated successfully.",
            "data" => $proposalkonten
            ]);
        }


    public function destroy($id)
    {
        $proposalkonten = ProposalKonten::findOrFail($id);

        $data = $proposalkonten->delete();
        
        if ($data){
            return response()->json([
                "success" => true,
                "message" => "konten deleted successfully.",
            ]);
        }
    }
}
