<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Table;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\orderTable;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //  Danh sách đơn
    public function index(Request $request)
    {
        $query = Order::with('table', 'customer')->latest();

        if ($request->has('keyword')) {
            $keyword = $request->keyword;

            $query->whereHas('customer', function ($q) use ($keyword) {
                $q->where('name', 'like', "%$keyword%");
            })->orWhereHas('table', function ($q) use ($keyword) {
                $q->where('table_number', 'like', "%$keyword%");
            })->orWhere('status', 'like', "%$keyword%");
        }
        return response()->json($query->get());
    }

    // Chi tiết đơn
    public function show($id)
    {
        $order = Order::with('table', 'customer')->findOrFail($id);
        return response()->json($order);
    }

    //  Tạo đơn mới


    // Cập nhật trạng thái
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status ?? 'pending';
        $order->save();

        return response()->json(['message' => 'Order status updated', 'order' => $order]);
    }

    //  Xoá đơn
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json(['message' => 'Order deleted']);
    }

    //  Lấy đơn theo ngày
    public function getByDate($date)
    {
        $orders = Order::with('table', 'customer')
            ->where('reservation_date', $date)
            ->orderBy('reservation_time')
            ->get();

        return response()->json($orders);
    }


    // 💡 Gợi ý bàn theo số khách

    // lấy ra đơn hàng
    public function getOrder()
    {
        $order = Order::with("items")
            ->select("id", "name", "status", "reservation_date", "reservation_time", "total_price")->get();
        return response()->json($order);
    }
    public function statsDashbroad()
    {
        $totalOrder = Order::where('status', 'confirmed')->count();
        $totalRevenue = Order::where('status', 'confirmed')->sum('total_price');
        $totalCustomers = Customer::count();
        return response()->json([
            "statOrder" => $totalOrder,
            "statTotal" => $totalRevenue,
            "statCustomer" => $totalCustomers
        ]);
    }

    // Lấy danh sách bàn còn trống theo ngày và giờ

    // Đặt nhiều bàn cho 1 khách hàng, tạo 1 hóa đơn (order) cho các bàn đó
    public function bookTables(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'table_ids' => 'required|array',
            'table_ids.*' => 'exists:tables,id',
            'reservation_date' => 'required|date',
            'reservation_time' => 'required|date_format:H:i:s',
            'payment_method_id' => 'nullable|exists:payment_methods,id',
            'voucher_id' => 'nullable|exists:vouchers,id',
            'note' => 'nullable|string',
            'total_price' => 'required|numeric'
        ]);

        // 1. Tạo hóa đơn (order) trước
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'payment_method_id' => $request->payment_method_id,
            'voucher_id' => $request->voucher_id,
            'total_price' => $request->total_price,
            'note' => $request->note,
        ]);

        $tableIds = $request->table_ids;
        $date = $request->reservation_date;
        $time = $request->reservation_time;

        // 2. Thêm các bàn vào order_tables, luôn truyền order_id
        $orderTableIds = [];
        foreach ($tableIds as $tableId) {
            $orderTableIds[] = DB::table('order_tables')->insertGetId([
                'order_id' => $order->id,
                'table_id' => $tableId,
                'reservation_date' => $date,
                'reservation_time' => $time,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return response()->json([
            'message' => 'Đặt bàn thành công',
            'order_id' => $order->id,
            'order_table_ids' => $orderTableIds,
            'booked_tables' => $tableIds,
        ]);
    }
}
