<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;



class MemberController extends Controller
{

    public function index()
    {
        $member = Member::all();
        return $member;
    }
    
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required',
            'age' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
        ]);
        if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }
    $member = Member::create($input);
    return response()->json([
        "success" => true,
        "message" => "member created successfully.",
        "data" => $member
    ]);
    }

    public function show($id)
    {
        $member = Member::find($id);
        if (is_null($member)) {
            return $this->sendError('Member not found.');
        }
        return response()->json([
            "success" => true,
            "message" => "Member retrieved successfully.",
            "data" => $member
        ]);
    }

    public function update(Request $request, Member $member)
    {
            $member = Member::find($request->id);
            $member->name = $request->name;
            $member->email = $request->email;
            $member->age = $request->age;
            $member->phone_number = $request->phone_number;
            $member->address = $request->address;
            $member->save();

            return response()->json([
            "success" => true,
            "message" => "Member updated successfully.",
            "data" => $member
            ]);
        }

    public function search($name)
    {
        return Member::where('name', 'like', '%'.$name.'%')->get();
    }

    public function destroy($id)
    {
        $member = Member::findOrFail($id);

        $data = $member->delete();
        
        if ($data){
            return response()->json([
                "success" => true,
                "message" => "Member deleted successfully.",
                "data" => $member
            ]);
        }
    }

}