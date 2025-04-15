<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;

use Illuminate\Support\Facades\Http;

class GoogleWebController extends Controller
{
    public function redirectToGoogle()
    {
        return \Laravel\Socialite\Facades\Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
    
        $googleController = new GoogleController();
        $request = new \Illuminate\Http\Request([
            'access_token' => $googleUser->token
        ]);
    
        // Gọi xử lý Google login để tạo tài khoản và token
        $response = $googleController->loginWithGoogle($request);
    
        // Nếu login thất bại, redirect về login
        if ($response->status() !== 200) {
            return redirect('/login')->withErrors('Đăng nhập Google thất bại.');
        }
    
        $data = $response->getData(true);
    
        // Lưu token vào session nếu cần
        session(['token' => $data['token']]);
    
        return redirect('/');
    }
}    
