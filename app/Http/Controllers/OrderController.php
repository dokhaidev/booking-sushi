<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Customer;
// use App\Mail\OrderConfirmationMail; // Uncomment if you implement mail later

class OrderController extends Controller
{
    // 🔍 Danh sách đơn đặt
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

    //  Chi tiết đơn
    public function show($id)
    {
        $order = Order::with('table', 'customer')->findOrFail($id);
        return response()->json($order);
    }

    //  Đặt bàn
    public function store(Request $request)
    {
        $validated = $request->validate([
            'table_id' => 'required|exists:tables,id',
            'customer_id' => 'nullable|exists:customers,id',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|in:pending,confirmed,checked_in,completed,cancelled',
            'reservation_date' => 'nullable|date',
            'reservation_time' => 'nullable|date_format:H:i',
            'guests' => 'required|integer|min:1',
        ]);

        $existingOrder = Order::where('table_id', $validated['table_id'])
            ->where('reservation_date', $validated['reservation_date'])
            ->where('reservation_time', $validated['reservation_time'])
            ->whereIn('status', ['pending', 'confirmed'])
            ->first();

        if ($existingOrder) {
            return response()->json(['message' => 'This table is already booked at this time.'], 422);
        }

        $table = Table::find($validated['table_id']);

        if ($table->status !== 'available') {
            return response()->json(['message' => 'Table is not available'], 422);
        }

        $table->status = 'reserved';
        $table->save();

        $order = Order::create($validated);

        // if ($order->customer && $order->customer->email) {
        //     Mail::to($order->customer->email)->send(new OrderConfirmationMail($order));
        // }

        return response()->json(['message' => 'Order placed successfully', 'order' => $order], 201);
    }

    // 🔄 Cập nhật trạng thái
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,checked_in,completed,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        if (in_array($request->status, ['completed', 'cancelled'])) {
            $order->table->status = 'available';
            $order->table->save();
        } elseif ($request->status === 'checked_in') {
            $order->table->status = 'occupied';
            $order->table->save();
        }

        return response()->json(['message' => 'Order status updated', 'order' => $order]);
    }

    //  Xoá đơn
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        $order->table->status = 'available';
        $order->table->save();

        return response()->json(['message' => 'Order deleted']);
    }

    //  Lịch theo ngày
    public function getByDate($date)
    {
        $orders = Order::with('table', 'customer')
            ->where('reservation_date', $date)
            ->orderBy('reservation_time')
            ->get();

        return response()->json($orders);
    }

    // Gợi ý bàn theo số khách
    public function suggestTable(Request $request)
    {
        $guests = $request->input('guests', 1);

        $tables = Table::where('status', 'available')
            ->where('max_guests', '>=', $guests)
            ->get();

        return response()->json($tables);
    }

    // Check-in
    public function checkIn($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'checked_in';
        $order->save();

        $order->table->status = 'occupied';
        $order->table->save();

        return response()->json(['message' => 'Customer checked in.']);
    }

    // 🛌 Check-out
    public function checkOut($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'completed';
        $order->save();

        $order->table->status = 'available';
        $order->table->save();

        return response()->json(['message' => 'Customer checked out.']);
    }
}
