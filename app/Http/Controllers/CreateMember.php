<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Stringable;

class CreateMember extends Controller
{

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

    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'age'=> 'required',
            'phone_number'=> 'required', 
            'address'=> 'required',             
        ]);
        
        $member = Member::findOrFail($id);
        $member->update([
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'slug' => Str::slug($request->title)
        ]);

        return response()->json([
                        'message' => 'member successfully updated',
                    ], 200);
            
                    if ($this->fails()) {
                        return response()->json([
                            'message' => 'updating fails',
                            'errors' => $this->errors(),
                        ], 422);
                    }
        $this->assignRole('tenant');

        
    }

    public function destroy($id)
    {
        $user = Member::find($id);
        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Member deleted successfully',
        ], 200);
    }

}