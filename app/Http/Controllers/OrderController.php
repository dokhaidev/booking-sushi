<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Table;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use League\CommonMark\Node\Query\OrExpr;

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
    $validated = $request->validate([
        'reservation_date' => 'required|date',
        'reservation_time' => 'required',
        'guests' => 'required|integer|min:1',
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
                'email' => 'required|email',
        'note' => 'required',
        'customer_id'=>  'nullable'
    ]);

    $validated['status'] = 'pending';

    $reservationDateTime = Carbon::parse($validated['reservation_date'] . ' ' . $validated['reservation_time']);
    $startWindow = $reservationDateTime->copy()->subHours(2);
    $endWindow = $reservationDateTime->copy()->addHours(2);

    // Tìm tất cả bàn có thể chứa nhóm khách
    $tables = Table::where('max_guests', '>=', $validated['guests'])
        ->orderBy('max_guests') // ưu tiên bàn nhỏ hơn
        ->get();

    foreach ($tables as $table) {
        // Tính tổng số khách đã đặt bàn này trong khoảng thời gian đó
        $existingGuests = Order::where('table_id', $table->id)
            ->where('reservation_date', $validated['reservation_date'])
            ->whereTime('reservation_time', '>=', $startWindow->format('H:i:s'))
            ->whereTime('reservation_time', '<=', $endWindow->format('H:i:s'))
            ->sum('guests');

        // Nếu bàn vẫn còn chỗ
        if (($existingGuests + $validated['guests']) <= $table->max_guests) {
            $validated['table_id'] = $table->id;

            // Tạo đơn đặt bàn
            $order = Order::create($validated);

            $table->status = 'reserved';
            $table->save();

            return response()->json(['message' => 'Reservation created', 'data' => $order], 201);
        }
    }
    return response()->json(['message' => 'No available table for the selected time and guest count'], 422);
}

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
    public function suggestTable(Request $request)
    {
        $guests = $request->input('guests', 1);

        $tables = Table::where('status', 'available')
            ->where('max_guests', '>=', $guests)
            ->get();

        return response()->json($tables);
    }
    // lấy ra đơn hàng
    public function getOrder(){
        $order = Order::with("items")
        ->select("id","name","status","reservation_date","reservation_time","total_price") -> get();
        return response() -> json($order);
    }
    public function statsDashbroad (){
        $totalOrder = Order::where('status', 'confirmed')->count();
        $totalRevenue = Order::where('status', 'confirmed')->sum('total_price');
        $totalCustomers = Customer::count();
        return response()->json([
           "statOrder"=> $totalOrder ,
           "statTotal"=> $totalRevenue,
            "statCustomer"=>$totalCustomers
        ]);

    }
}
