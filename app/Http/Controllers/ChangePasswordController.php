<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
  
class ChangePasswordController extends Controller
{
    

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => ['required'],
            'password' => ['required'],
            'confirm_password' => ['same:password'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validations fails',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user=$request->user();
        if(Hash::check($request->current_password, $user->password)){
            $user->update([
                'password' => Hash::make($request->password),
            ]);
            return response()->json([
                'message' => 'password successfully update',
            ], 200); 
        }
        else{
            return response()->json([
                'message' => 'current password does not matched',
            ], 400);  
        }
    } 
}