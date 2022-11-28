<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Dingo\Api\Auth\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Traits\HasRoles;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'password_confirmation' => Hash::make($request->password_confirmation),
        ]);

        $user->assignRole($request->role);

        $token = auth()->login($user);
        
        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => $token
        ]);

        Mail::send('emails.verifyUser', ['user' => $user, 'verifyUser' => $verifyUser, 'token' => $token], function($mail) use ($user) {
            $mail->to($user->email, $user->name);
            $mail->subject('Verify your email address');
        });

        return response()->json([
            'status' => 'success',
            'message' => 'We sent you an activation code. Check your email and click on the link to verify.',
            'token' => $token
        ], 200);

        return $this->respondWithToken($token);
    }
    
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => ['required', 'string', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }

        $credentials = $request->only('email', 'password');

        if ($token = auth()->attempt($credentials)) {
            if (auth()->user()->hasRole('admin')) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Login success',
                    'token' => $token,
                    'role' => 'admin'
                ], 200);
            } elseif (auth()->user()->hasRole('mentor')) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Login success',
                    'token' => $token,
                    'role' => 'mentor'
                ], 200);
            } elseif (auth()->user()->hasRole('juri')) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Login success',
                    'token' => $token,
                    'role' => 'juri'
                ], 200);
            } elseif (auth()->user()->hasRole('tenant')) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Login success',
                    'token' => $token,
                    'role' => 'tenant'
                ], 200);
            } elseif (auth()->user()->hasRole('talent')) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Login success',
                    'token' => $token,
                    'role' => 'talent'
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Login Gagal',
                ], 401);
            }
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function refresh()
    {
        if ($token = auth()->refresh()) {
            return $this->respondWithToken($token);
        }
        else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function me()
    {
        return response()->json(auth()->user());
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

    private function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
