<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify($user_id, Request $request)
    {
        if (!$request->hasValidSignature()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or expired url provided.',
            ], 401);
        }

        $user = User::findOrFail($user_id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            event(new Verified($user));
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Email successfully verified.',
        ], 200);
    }

    public function resend()
    {
        if (auth()->user()->hasVerifiedEmail()) {
            return response()->json(['message' => 'Already verified'], 422);
        }

        auth()->user()->sendEmailVerificationNotification();

        return response()->json(['message' => 'Verification link sent']);
    }
}
