<?php

namespace App\Http\Controllers;

use App\Models\ProfileTalent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileTalentController extends Controller
{
    public function index()
    {
        $profileTalent = ProfileTalent::all();
        return $profileTalent;
    }
    
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'profile_image'=> 'required|mimes:jpeg,png,jpg|max:4048',
            'profile_number' => 'required',
            'profile_age' => 'required',
            'profile_address_province' => 'required',
            'profile_address_city' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);       
    }
    $profileTalent = ProfileTalent::create($input);
    $profileTalent->profile_image = $request->file('profile_image')->store('/public/storage/Profile Tenant Images');
    $profileTalent->profile_number = $request->profile_number;
    $profileTalent->profile_age = $request->profile_age;
    $profileTalent->profile_address_province = $request->profile_address_province;
    $profileTalent->profile_address_city = $request->profile_address_city;
    

    $profileTalent_image = Storage::url($profileTalent->profile_image);

    $profileTalent->update([
        'profile_image' => $profileTalent_image,
    ]);
    return response()->json([
        "success" => true,
        "message" => "data created successfully.",
        "data" => $profileTalent
    ]);
    }

    public function show($id)
    {
        $profileTalent = ProfileTalent::find($id);
        if (is_null($profileTalent)) {
            return $this->sendError('data not found.');
        }
        return response()->json([
            "data" => $profileTalent
        ]);
    }

    public function update(Request $request, ProfileTalent $profileTalent)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'profile_image'=> 'required|mimes:jpeg,png,jpg|max:4048',
            'profile_number' => 'required',
            'profile_age' => 'required',
            'profile_address_province' => 'required',
            'profile_address_city' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }
            $profileTalent = ProfileTalent::find($request->id);
            $profileTalent->profile_image = $request->file('profile_image')->store('/public/storage/Profile Tenant Images');
            $profileTalent->profile_number = $request->profile_number;
            $profileTalent->profile_age = $request->profile_age;
            $profileTalent->profile_address_province = $request->profile_address_province;
            $profileTalent->profile_address_city = $request->profile_address_city;
            $profileTalent->save();

            return response()->json([
            "success" => true,
            "message" => "data updated successfully.",
            "data" => $profileTalent
            ]);
        }


    public function destroy($id)
    {
        $profileTalent = ProfileTalent::findOrFail($id);

        $data = $profileTalent->delete();
        
        if ($data){
            return response()->json([
                "success" => true,
                "message" => "data deleted successfully.",
            ]);
        }
    }
}
