<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index(Request $request)
    {
        $query = Order::with(['user', 'items.course'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        $orders = $query->paginate(15);
        
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        $order->load(['user', 'items.course']);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Approve the order.
     */
    public function approve(Order $order)
    {
        $order->update([
            'payment_status' => 'paid',
            'status' => 'completed',
            'notes' => ($order->notes ? $order->notes . "\n" : "") . "Approved by admin on " . now()->toDateTimeString(),
        ]);

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Order approved successfully. User now has access to the course.');
    }

    /**
     * Disapprove/Cancel the order.
     */
    public function disapprove(Order $order, Request $request)
    {
        $order->update([
            'payment_status' => 'failed',
            'status' => 'cancelled',
            'notes' => ($order->notes ? $order->notes . "\n" : "") . "Disapproved by admin on " . now()->toDateTimeString() . ". Reason: " . ($request->reason ?? 'No reason provided'),
        ]);

        return redirect()->route('admin.orders.show', $order)
            ->with('info', 'Order disapproved and cancelled.');
    }
}
