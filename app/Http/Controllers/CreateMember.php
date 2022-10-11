<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Stringable;


class CreateMember extends Controller
{

    public function index()
    {
        //
    }
    
    public function store()
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'age'=> 'required',
            'phone_number'=> 'required', 
            'address'=> 'required',             
        ]);
        
        Member::create(request(['name', 'email', 'age', 'phone_number', 'address']));
        
        return response()->json([
                        'message' => 'member successfully created',
                    ], 200);
            
                    if ($this->fails()) {
                        return response()->json([
                            'message' => 'creating fails',
                            'errors' => $this->errors(),
                        ], 422);
                    }
        $this->assignRole('tenant');  
    }

    public function show($id)
    {
        $member = Member::all();
        return 
    }

    public function update(Request $request, Member $member)
    {
        // $member->validate(request(), [
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'age'=> 'required',
        //     'phone_number'=> 'required', 
        //     'address'=> 'required',             
        // ]);
        
        // $member = Member::findOrFail($id);
        $member->update($request->all());

        return response()->json([
                        'message' => 'member successfully updated',
                    ], 200);
            
                    if ($this->fails()) {
                        return response()->json([
                            'message' => 'updating fails',
                            'errors' => $this->errors(),
                        ], 422);
                    }
        
    }

    public function destroy($id, Member $member)
    {
        $member = Member::find($id);
        $member->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Member deleted successfully',
        ], 200);
    }

}