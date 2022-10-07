<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class CreateMember extends Controller
{
    public $members, $name, $email, $age, $phone_number, $address, $status, $member_id;

    public function store()
    {
         
        $member = Member::updateOrCreate(['id' => $this->member_id], [
            'name' => $this->name,
            'email' => $this->email,
            'age' => $this->age,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'status' => $this->status,
        ]);
        
        return response()->json([
            'message' => 'member successfully created',
        ], 200);

        if ($member->fails()) {
            return response()->json([
                'message' => 'creating fails',
                'errors' => $member->errors(),
            ], 422);
        }
    }

}
