<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function show(){
        return view('auth.passwords.email');
    }
     public function sendResetLinkEmail(Request $request)
    {
        
    
    $request->validate([
        'email' => 'required|email',
    ]);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    if ($status === Password::RESET_LINK_SENT) {
        
        return back()->with('status', 'Password reset link has been sent to your email.');
    }

    return back()->withErrors(['email' => 'Unable to send reset link.']);
}
public function showReset(){
    return view('auth.passwords.reset');
}

}
