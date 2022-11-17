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
            'proposal_abstrak' => 'required|min:100|max:2500',
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
        "message" => "abstrak created successfully.",
        "data" => $proposal
    ]);
    }

    public function show($id)
    {
        $proposal = Proposal::find($id);
        if (is_null($proposal)) {
            return $this->sendError('abstrak not found.');
        }
        return response()->json([
            "data" => $proposal
        ]);
    }

    public function update(Request $request, Proposal $proposal)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'proposal_abstrak' => 'required|min:100|max:2500',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }
            $proposal = Proposal::find($request->id);
            $proposal->proposal_abstrak = $request->proposal_abstrak;
            $proposal->proposal_status = $request->proposal_status;
            $proposal->save();

            return response()->json([
            "success" => true,
            "message" => "abstrak updated successfully.",
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
                "message" => "abstrak deleted successfully.",
            ]);
        }
    }
}
