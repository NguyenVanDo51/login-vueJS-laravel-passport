<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use App\Notifications\ResetPasswordRequest;
use Carbon\Carbon;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ResetPasswordController extends Controller
{
    public function sendMail(Request $request)
    {
        // lay ra user tu email
        $user = User::query()->where('email', $request->input('email'))->firstOrFail();

        // Tao token de doi password
        $passwordReset = PasswordReset::query()->updateOrCreate([
            'email' => $user->email,
            'token' => Hash::make(Str::random(60))
        ]);

        // Tao thanh cong thi gui mail thong bao
        if ($passwordReset) {
            $user->notify(new ResetPasswordRequest($passwordReset->token, $request->input('redirect')));
        }

        return response()->json([
            'message' => 'We have e-mailed your password reset link!',
            'email' => $user->email,
            'token' => $passwordReset->token
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'password' => 'required'
        ]);

        try{
            $passwordReset = PasswordReset::query()->where('token', $request->input('token'))->firstOrFail();

        } catch (NotFoundHttpException $exception) {
            return response()->json([
               'message' => 'Token invalid!'
            ]);
        }

//         Neu token qua lau thi xoa di
        if (Carbon::parse($passwordReset->updated_at)->addMinute(720)->isPast()) {
            $passwordReset->delete();

            return response()->json([
                'message' => 'This is reset password is invalid'
            ]);
        }

        $user = User::query()->where('email', $passwordReset->email)->firstOrFail();

        $updatePasswordUser = $user->update(['password' => Hash::make($request->input('password'))]);
        $user->forceFill([
            'password' => Hash::make($request->input('password')),
        ])->save();
        $passwordReset->delete();

        return response()->json([
            'success' => $updatePasswordUser,
        ]);
    }
}
