<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CustomerVoucher;
use App\Models\Customer;
use App\Models\Voucher;


class CustomerVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {

        $voucher = CustomerVoucher::where('customer_id', $id)
            ->with(['voucher'])
            ->get();
        $vouchers = $voucher->map(function ($item) {
            return [
                'id' => $item->voucher->id,
                'code' => $item->voucher->code,
                'discount_value' => $item->voucher->discount_value,
                'start_date' => $item->voucher->start_date,
                'end_date' => $item->voucher->end_date,
                'status' => $item->voucher->status,
            ];
        });
        if ($vouchers->isEmpty()) {
            return response()->json(['message' => 'Không có voucher nào'], 404);
        }
        return response()->json([
            'message' => 'Danh sách voucher của khách hàng',
            'data' => $vouchers
        ]);
    }



    public function exchangePoints(Request $request)
    {
        $request->validate([
            'voucher_id' => 'required|exists:vouchers,id',
            'customer_id' => 'required|exists:customers,id',
        ]);
        $customer = Customer::where("id", $request->customer_id)->firstOrFail();
        $voucher = Voucher::where("id", $request->voucher_id)->firstOrFail();

        if ($customer->point < $voucher->required_points) {
            return response()->json([
                "message" => "bạn không đủ điểm để đổi",
            ]);
        }
        if ($voucher->usage_limit < 1) {
            return response()->json([
                "message" => "Voucher này đã hết",
            ]);
        }
        $customer->point  -= $voucher->required_points;
        $customer->save();

        $voucher->usage_limit = $voucher->usage_limit - 1;;
        $voucher->save();
        $customer_voucher  =  [
            'customer_id' => $request->customer_id,
            'voucher_id' => $request->voucher_id,
            "assigned_at" => now(),
            "date" => $voucher->end_date
        ];
        CustomerVoucher::create($customer_voucher);
        return response()->json([
            "message" => "đã đổi voucher thành công",
            "thông tin voucher" => CustomerVoucher::where("customer_id", $request->customer_id)->get()
        ]);
    }
}
