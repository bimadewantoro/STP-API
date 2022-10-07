<?php

namespace App\Http\Controllers;

use App\Models\Member;


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

}