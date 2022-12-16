<?php

namespace App\Http\Controllers;

use App\Models\UserSewaAlat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserSewaAlatController extends Controller
{
    public function index()
    {
        $userSewaAlat = UserSewaAlat::all();
        return $userSewaAlat;
    }
    
    public function store(Request $request)
    {
        $input = $request->all();
        $userSewaAlat = UserSewaAlat::create($input);
        return response()->json([
            "success" => true,
            "message" => "success",
            "data" => $userSewaAlat
        ]);
    }

    public function show($id)
    {
        $userSewaAlat = UserSewaAlat::find($id);
        if (is_null($userSewaAlat)) {
            return $this->sendError('not found.');
        }
        return response()->json([
            "data" => $userSewaAlat
        ]);
    }

    public function update(Request $request, UserSewaAlat $userSewaAlat)
    {
        $input = $request->all();
        
            $userSewaAlat = UserSewaAlat::find($request->id);
            $userSewaAlat->add_alat_sewa_id = $request->add_alat_sewa_id;
            $userSewaAlat->user_id = $request->user_id;
            $userSewaAlat->save();

            return response()->json([
            "success" => true,
            "message" => "updated successfully.",
            "data" => $userSewaAlat
            ]);
        }


    public function destroy($id)
    {
        $userSewaAlat = UserSewaAlat::findOrFail($id);

        $data = $userSewaAlat->delete();
        
        if ($data){
            return response()->json([
                "success" => true,
                "message" => "deleted successfully.",
            ]);
        }
    }
}
