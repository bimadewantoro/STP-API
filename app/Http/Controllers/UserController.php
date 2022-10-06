<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Mail\VerifyMail;
use App\Models\VerifyUser;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Exceptions\JWTException;
    



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'password_confirmation' => Hash::make($request->password_confirmation),
        ]);

        $user->assignRole('tenant');

        $token = auth()->login($user);
        
        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => $token
        ]);

        Mail::send('emails.verifyUser', ['user' => $user, 'verifyUser' => $verifyUser, 'token' => $token], function($mail) use ($user) {
            $mail->from(getenv('MAIL_FROM_ADDRESS'), getenv('MAIL_FROM_NAME'));
            $mail->to($user->email, $user->name);
            $mail->subject('Verify your email address');
        });

        return response()->json([
            'status' => 'success',
            'message' => 'We sent you an activation code. Check your email and click on the link to verify.'
        ], 200);

        // try {
        //     $token = auth()->login($user);
        // } catch (JWTException $e) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Could not create token',
        //     ], 500);
        // }

        return $this->respondWithToken($token);

    }

    private function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [ 
            'name' => 'required',
            'oldpassword' => 'required',
            'newpassword' => 'required',
        ]);
 
        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword , $hashedPassword)) {
            if (Hash::check($request->newpassword , $hashedPassword)) {
 
                $users = user::find(Auth::user()->id);
                $users->password = bcrypt($request->newpassword);
                $users->save();
                session()->flash('message','password updated successfully');
                return redirect()->back();
            }
            else{
                session()->flash('message','new password can not be the old password!');
                return redirect()->back();
            } 
        }
        else{
            session()->flash('message','old password doesnt matched');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User deleted successfully',
        ], 200);
    }

    
    
    
}
