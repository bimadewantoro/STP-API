<?php

namespace App\Http\Controllers;

use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserDetailsController extends Controller
{
    public function index()
    {
        $userDetails = UserDetails::all();
        return $userDetails;
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
    $userDetails = UserDetails::create($input);
    $userDetails->user_id = auth()->id();
    $userDetails->profile_image = $request->file('profile_image')->store('/public/storage/Profile User Details Images');
    $userDetails->profile_number = $request->profile_number;
    $userDetails->profile_age = $request->profile_age;
    $userDetails->profile_address_province = $request->profile_address_province;
    $userDetails->profile_address_city = $request->profile_address_city;
    

    $userDetails_image = Storage::url($userDetails->profile_image);

    $userDetails->update([
        'profile_image' => $userDetails_image,
    ]);
    return response()->json([
        "success" => true,
        "message" => "data created successfully.",
        "data" => $userDetails
    ]);
    }

    public function show($id)
    {
        $userDetails = UserDetails::find($id);
        if (is_null($userDetails)) {
            return $this->sendError('data not found.');
        }
        return response()->json([
            "data" => $userDetails
        ]);
    }

    public function update(Request $request, UserDetails $userDetails)
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
            $userDetails = UserDetails::find($request->id);
            $userDetails->profile_image = $request->file('profile_image')->store('/public/storage/Profile User Details Images');
            $userDetails->profile_number = $request->profile_number;
            $userDetails->profile_age = $request->profile_age;
            $userDetails->profile_address_province = $request->profile_address_province;
            $userDetails->profile_address_city = $request->profile_address_city;
            $userDetails->save();

            return response()->json([
            "success" => true,
            "message" => "data updated successfully.",
            "data" => $userDetails
            ]);
        }


    public function destroy($id)
    {
        $userDetails = UserDetails::findOrFail($id);

        $data = $userDetails->delete();
        
        if ($data){
            return response()->json([
                "success" => true,
                "message" => "data deleted successfully.",
            ]);
        }
    }
}
