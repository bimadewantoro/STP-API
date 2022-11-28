<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{
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

    public function resend (Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Your email is already verified.',
            ], 401);
        }

        $user = $request->user();

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
            'message' => 'The notification has been resubmitted',
        ], 200);
    }
}
