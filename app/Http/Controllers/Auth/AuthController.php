<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password as FacadesPassword;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => ['required',
            'string',
            'min:8',             // must be at least 10 characters in length
            'regex:/[a-z]/',      // must contain at least one lowercase letter
            'regex:/[A-Z]/',      // must contain at least one uppercase letter
            'regex:/[0-9]/',      // must contain at least one digit
            'regex:/[@$!%*#?&.,+_-]/', // must contain a special character
            ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }

        $credentials = $request->only('email', 'password');

        if ($token = auth()->attempt($credentials)) {
            return $this->respondWithToken($token);
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

    public function update()
    {
        $request = request();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }

        $user = auth()->user();
        $user->name = $request->name;
        $user->password = bcrypt($request->password);

        if ($user->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'User updated successfully',
                'data' => $user,
            ], 200);
        }
        else {
            return response()->json([
                'status' => 'error',
                'message' => 'User could not be updated',
            ], 500);
        }
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
