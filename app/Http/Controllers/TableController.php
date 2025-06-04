<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\orderTable;
use App\Models\Customer;
use Illuminate\Support\Carbon;

class TableController extends Controller
{
    // Lấy danh sách tất cả bàn
    public function index(Request $request)
    {
        $query = Table::query();

        // Nếu có từ khóa tìm kiếm
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('table_number', 'like', "%$search%");
        }

        // Nếu có lọc theo trạng thái
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $tables = $query->get();
        return response()->json($tables);
    }

    public function availableTimes(Request $request)
    {
        $request->validate([
            'reservation_date' => 'required|date'
        ]);

        $date = $request->reservation_date;
        $times = [
            '10:00',
            '12:15',
            '14:30',
            '16:45',
            '18:00',
            '20:15',
            '22:30'
        ];

        $availableSlots = [];

        foreach ($times as $time) {
            $reservationDateTime = Carbon::parse("$date $time");
            $startWindow = $reservationDateTime->copy()->subHours(2);
            $endWindow = $reservationDateTime->copy()->addHours(2);

            // Sử dụng quan hệ orderTables thay vì orders
            $availableTables = Table::whereDoesntHave('orderTables', function ($q) use ($date, $startWindow, $endWindow) {
                $q->where('reservation_date', $date)
                    ->whereTime('reservation_time', '>=', $startWindow->format('H:i:s'))
                    ->whereTime('reservation_time', '<=', $endWindow->format('H:i:s'));
            })
                ->get();

            if ($availableTables->count() > 0) {
                $availableSlots[] = [
                    'time' => $time,
                    'tables' => $availableTables->map(function ($table) {
                        return [
                            'table_number' => $table->table_number,
                            'max_guests' => $table->max_guests
                        ];
                    })
                ];
            }
        }
        return response()->json([
            'date' => $date,
            'available_slots' => $availableSlots
        ]);
    }
    public function show($id)
    {
        $table = Table::find($id);

        if (!$table) {
            return response()->json(['message' => 'Table not found'], 404);
        }

        return response()->json($table);
    }

    // Tạo mới bàn
    public function store(Request $request)
    {
        $validated = $request->validate([
            'table_number' => 'required|string|max:255|unique:tables,table_number',
            'size' => 'required|integer|min:1',
            'max_guests' => 'required|integer|min:1',
            'status' => 'required|in:available,reserved,occupied',
        ]);

        $table = Table::create($validated);
        return response()->json($table, 201);
    }

    // Cập nhật bàn
    public function update(Request $request, $id)
    {
        $table = Table::find($id);

        if (!$table) {
            return response()->json(['message' => 'Table not found'], 404);
        }

        $validated = $request->validate([
            'table_number' => 'required|string|max:255|unique:tables,table_number,' . $id,
            'size' => 'required|integer|min:1',
            'max_guests' => 'required|integer|min:1',
            'status' => 'required|in:available,reserved,occupied',
        ]);

        $table->update($validated);
        return response()->json($table);
    }

    // Xóa bàn
    public function destroy($id)
    {
        $table = Table::find($id);

        if (!$table) {
            return response()->json(['message' => 'Table not found'], 404);
        }

        $table->delete();
        return response()->json(['message' => 'Table deleted successfully']);
    }
}