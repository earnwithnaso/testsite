<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * Initiate checkout for a course.
     */
    public function checkout(Request $request, Course $course)
    {
        $user = $request->user();

        // Check if already purchased OR has a pending order
        $existingOrder = $user->orders()->whereHas('items', function ($q) use ($course) {
            $q->where('course_id', $course->id);
        })->first();

        if ($existingOrder) {
            if ($existingOrder->payment_status === 'paid') {
                return redirect()->route('student.courses.show', $course->slug)
                    ->with('info', 'You already have access to this course.');
            } else {
                return redirect()->route('dashboard')
                    ->with('info', 'You have a pending enrollment for this course. Please wait for admin approval.');
            }
        }

        $bankDetails = SiteSetting::whereIn('key', ['bank_name', 'account_number', 'account_name'])
            ->pluck('value', 'key');
            
        $currencySymbol = SiteSetting::where('key', 'currency_symbol')->value('value') ?? '₦';

        return view('student.checkout.index', compact('course', 'bankDetails', 'currencySymbol'));
    }

    /**
     * Initialize Stripe Checkout session.
     */
    public function stripeSession(Request $request, Course $course)
    {
        // Using Laravel Cashier (Stripe)
        return $request->user()
            ->checkout([$course->stripe_price_id => 1], [
                'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('courses.show', $course->slug),
            ]);
    }

    /**
     * Initialize Paystack Payment (Manual implementation or using a package)
     */
    public function paystackInitialize(Request $request, Course $course)
    {
        // This is a placeholder for Paystack redirection logic
        // In a real app, you'd call Paystack API here
        return redirect()->away('https://checkout.paystack.com/placeholder');
    }

    /**
     * Process Bank Transfer submission.
     */
    public function processBankTransfer(Request $request, Course $course)
    {
        $request->validate([
            'payment_proof' => 'required|image|max:5120', // Max 5MB
        ]);

        $user = $request->user();

        // Save proof
        $path = $request->file('payment_proof')->store('payment_proofs', 'public');

        // Create Order
        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => 'ORD-' . strtoupper(Str::random(10)),
            'status' => 'pending',
            'payment_status' => 'pending',
            'total_amount' => $course->price,
            'payment_method' => 'bank_transfer',
            'payment_proof' => $path,
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'course_id' => $course->id,
            'price' => $course->price,
        ]);

        return redirect()->route('dashboard')->with('success', 'Payment proof submitted successfully! Your course will be available once the admin approves your payment.');
    }

    /**
     * Handle successful payment return.
     */
    public function success(Request $request)
    {
        // NOTE: In production, use Stripe Webhooks to fulfill the order.
        // This is where you would mark the order as 'paid' and enroll the user.
        
        return redirect()->route('dashboard')->with('success', 'Your enrollment was successful! Welcome to the course.');
    }
}
