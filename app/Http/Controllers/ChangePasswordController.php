<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class ChangePasswordController extends Controller
{
    public function index()
    {
        return view('changePassword');
    } 


    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required', 'string', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
            'new_confirm_password' => ['same:new_password'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        return response()->json([
            'status' => 'success',
            'message' => 'Password changed successfully',
        ], 200);
    } 

    public function changeName(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }

        User::find(auth()->user()->id)->update(['name'=> $request->name]);

        return response()->json([
            'status' => 'success',
            'message' => 'Name changed successfully',
        ], 200);
    }
}