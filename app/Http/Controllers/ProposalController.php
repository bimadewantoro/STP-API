<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProposalController extends Controller
{
    public function index()
    {
        $proposal = Proposal::all();
        return $proposal;
    }
    
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'proposal_judul' => 'required|string|max:150',
            'proposal_kategori' => 'required',
            'proposal_bab1' => 'nullable',
            'proposal_bab2' => 'nullable',
            'proposal_bab3' => 'nullable',
            'proposal_bab4' => 'nullable',
            'proposal_bab5' => 'nullable',
            'proposal_bab6' => 'nullable',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);       
    }
    $proposal = Proposal::create($input);
    return response()->json([
        "success" => true,
        "message" => "proposal created successfully.",
        "data" => $proposal
    ]);
    }

    public function show($id)
    {
        $proposal = Proposal::find($id);
        if (is_null($proposal)) {
            return $this->sendError('proposal not found.');
        }
        return response()->json([
            "data" => $proposal
        ]);
    }

    public function update(Request $request, Proposal $proposal)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'proposal_judul' => 'required|string|max:150',
            'proposal_kategori' => 'required',
            'proposal_bab1' => 'nullable',
            'proposal_bab2' => 'nullable',
            'proposal_bab3' => 'nullable',
            'proposal_bab4' => 'nullable',
            'proposal_bab5' => 'nullable',
            'proposal_bab6' => 'nullable',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }
            $proposal = Proposal::find($request->id);
            $proposal->proposal_judul = $request->proposal_judul;
            $proposal->proposal_kategori = $request->proposal_kategori;
            $proposal->save();

            return response()->json([
            "success" => true,
            "message" => "proposal updated successfully.",
            "data" => $proposal
            ]);
        }


    public function destroy($id)
    {
        $proposal = Proposal::findOrFail($id);

        $data = $proposal->delete();
        
        if ($data){
            return response()->json([
                "success" => true,
                "message" => "proposal deleted successfully.",
            ]);
        }
    }
}
