<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $data = $request->all();

        // Không kiểm tra bàn có bận không, không validate
        $order = Order::create($data);

        return response()->json(['message' => 'Order placed successfully', 'order' => $order], 201);
    }

    // Cập nhật trạng thái
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status ?? 'pending';
        $order->save();

        return response()->json(['message' => 'Order status updated', 'order' => $order]);
    }

    // 🗑 Xoá đơn
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
    public function suggestTable(Request $request)
    {
        $guests = $request->input('guests', 1);

        $tables = Table::where('status', 'available')
            ->where('max_guests', '>=', $guests)
            ->get();

        return response()->json($tables);
    }


}
