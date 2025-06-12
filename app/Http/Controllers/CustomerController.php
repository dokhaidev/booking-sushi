<?php

namespace App\Http\Controllers;

use App\Models\Customer as Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response()->json($request->user());
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|min:6',
            'phone'    => 'required|digits_between:10,15',
        ]);

        $customer = Customers::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),

        ]);

        $token = $customer->createToken('authen_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'customer'     => $customer,
        ], 201);
    }


    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Tài khoản hoặc mật khẩu không đúng'], 401);
        }

        $customer = Customers::where('email', $request->email)->firstOrFail();
        $token = $customer->createToken('authen_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'Bearer',
        ], 200);
    }


    public function show(string $id)
    {
        $customer = Customers::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Không tìm thấy khách hàng'], 404);
        }
        return response()->json($customer);
    }


    public function update(Request $request, string $id)
    {
        $customer = Customers::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Người dùng không tồn tại'], 404);
        }

        $request->validate([
            'name'     => 'nullable|string|max:255',
            'email'    => 'nullable|string|email|max:255|unique:customers,email,' . $id,
            'phone'    => 'nullable|digits_between:10,15',
            'password' => 'nullable|string|min:6',
        ]);

        $customer->name  = $request->name ?? $customer->name;
        $customer->email = $request->email ?? $customer->email;
        $customer->phone = $request->phone ?? $customer->phone;

        if ($request->filled('password')) {
            $customer->password = bcrypt($request->password);
        }

        $customer->save();

        return response()->json($customer);
    }


    public function destroy(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Đăng xuất thành công']);
    }

    // Lấy danh sách tất cả người dùng cho admin
    public function listAll()
    {
        $customers = Customers::all();
        return response()->json($customers);
    }

    // Khoá hoặc mở khoá tài khoản khách hàng
    public function lockUnlock($id, Request $request)
    {
        $customer = Customers::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Không tìm thấy khách hàng'], 404);
        }

        $request->validate([
            'status' => 'required|in:active,locked,0,1'
        ]);

        // Nếu dùng kiểu boolean: 1 (active), 0 (locked)
        // Nếu dùng kiểu string: 'active', 'locked'
        $customer->status = $request->status;
        $customer->save();

        return response()->json([
            'message' => $customer->status == 'locked' || $customer->status == 0 ? 'Đã khoá tài khoản' : 'Đã mở khoá tài khoản',
            'customer' => $customer
        ]);
    }
}
