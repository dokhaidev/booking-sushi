<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
class ResetPasswordController extends Controller
{
    public function reset(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'password' => 'required|min:6',
        ]);

        // Tìm token khớp trong bảng password_reset_tokens
        $record = DB::table('password_reset_tokens')
            ->where('created_at', '>=', now()->subMinutes(10)) // Token chưa hết hạn
            ->get();

        $matched = $record->first(function ($item) use ($request) {
            return Hash::check($request->token, $item->token);
        });

        if (!$matched) {
            return response()->json(['message' => 'Token không hợp lệ hoặc đã hết hạn.'], 400);
        }

        $user = Customer::where('email', $matched->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Không tìm thấy người dùng.'], 404);
        }

        // Đặt lại mật khẩu
        $user->password = Hash::make($request->password);
        $user->save();

        // Xóa token sau khi dùng
        DB::table('password_reset_tokens')->where('email', $matched->email)->delete();

        return response()->json(['message' => 'Đặt lại mật khẩu thành công!'], 200);
    }
}
