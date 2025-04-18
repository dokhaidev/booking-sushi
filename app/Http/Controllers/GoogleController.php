<?php
namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\Customer;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = Customer::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'password' => bcrypt(Str::random(16)), // bắt buộc nếu bạn có validate password
            ]
        );

        $token = $user->createToken('google-token')->plainTextToken;

        // ✅ frontend sẽ nhận được token và thông tin user
        return redirect("http://localhost:5173/google/callback?token=$token");
    }
}
    
