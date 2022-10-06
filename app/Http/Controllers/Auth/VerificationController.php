<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    // public function verify($user_id, Request $request)
    // {
    //     if (!$request->hasValidSignature()) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Invalid or expired url provided.',
    //         ], 401);
    //     }

    //     $user = User::findOrFail($user_id);

    //     if (!$user->hasVerifiedEmail()) {
    //         $user->markEmailAsVerified();
    //         event(new Verified($user));
    //     }

    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Email successfully verified.',
    //     ], 200);
    // }

    // public function resend()
    // {
    //     if (auth()->user()->hasVerifiedEmail()) {
    //         return response()->json(['message' => 'Already verified'], 422);
    //     }

    //     auth()->user()->sendEmailVerificationNotification();

    //     return response()->json(['message' => 'Verification link sent']);
    // }

    public function verifyUser ($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->verified) {
                $verifyUser->user->verified = 1;
                $verifyUser->user->email_verified_at = now();
                $verifyUser->user->save();
                $status = "Your e-mail is verified. You can now login.";
            }else{
                $status = "Your e-mail is already verified. You can now login.";
            }
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Sorry your email cannot be identified.',
            ], 401);
        }

        return response()->json([
            'status' => 'success',
            'message' => $status,
        ], 200);
    }
}
