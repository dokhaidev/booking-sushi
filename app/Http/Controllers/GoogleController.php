<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function index(){
        return view('login');
    }
    public function loginWithGoogle(Request $request)
    {
        $request->validate([
            'access_token' => 'required|string',
        ]);

        try {
            $googleUser = Socialite::driver('google')
                ->stateless()
                ->userFromToken($request->access_token);
        
            \Log::info('Google User', ['user' => $googleUser]); // Thêm dòng log
        
            $customer = Customer::where('email', $googleUser->getEmail())->first();
        
            if (!$customer) {
                $customer = Customer::create([
                    'name' => $googleUser->getName() ?? $googleUser->getEmail(),
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt(Str::random(16)),
                    'google_id' => $googleUser->id,
                ]);
            }
        
            $token = $customer->createToken('login')->plainTextToken;
        
            return response()->json([
                'user' => $customer,
                'token' => $token,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Invalid Google access token',
                'error' => $e->getMessage(),
            ], 401);
        }
        
    }
}
