<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;


class ForgotPasswordController extends Controller
{
    public function showForgetPasswordForm()
    {
        return view('password.forgetPassword');
    }

    public function resetPasswordLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );
        if ($status === Password::INVALID_USER){
            return redirect()->back()->withErrors(['error' => 'User Not Found']);
        }else{
            return redirect()->back()->with('success', 'A password reset link has been sent to '. $request->email );
        }
    }

    public function passwordResetForm($token)
    {
        return view('password.reset-password', ['token' => $token]);
    }

    public function submitResetPassword(Request $request)
    {

        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:4|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' =>$password
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );
        if ($status === Password::INVALID_TOKEN) {
            return redirect()->back()->withErrors(['error' => 'Invalid token provided']);
        }elseif ($status === Password::INVALID_USER){
            return redirect()->back()->withErrors(['error' => 'User Not Found']);
        }else{
            return redirect()->route('login-page')->with('success', 'Password has been successfully changed.');
        }

    }
}
