<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Cashier;

class CheckoutController extends Controller
{
    /**
     * Initiate checkout for a course.
     */
    public function checkout(Request $request, Course $course)
    {
        $user = $request->user();

        // Check if already purchased
        if ($user->orders()->whereHas('items', function ($q) use ($course) {
            $q->where('course_id', $course->id);
        })->exists()) {
            return redirect()->route('courses.show', $course->slug)
                ->with('info', 'You have already purchased this course.');
        }

        // Create Stripe Checkout Session
        // Note: In a real app, ensure STRIPE_KEY/SECRET are set in .env
        // We use $user->checkout() provided by Cashier
        
        // For individual products (One-time payment)
        // We need to pass 'price_data' manually or use a price ID if established in Stripe.
        // Or simpler: create a ephemeral session.
        
        try {
            $checkout = $user->checkoutCharge($course->price * 100, $course->title, 1, [
                'success_url' => route('checkout.success', ['course_id' => $course->id]) . '&session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('courses.show', $course->slug),
                'metadata' => [
                    'course_id' => $course->id,
                    'user_id' => $user->id,
                ],
            ]);

            return $checkout;
        } catch (\Exception $e) {
            // Fallback for demo/dev if Stripe not configured
            \Log::error('Stripe Checkout Error: ' . $e->getMessage());
            return redirect()->route('courses.show', $course->slug)
                ->with('error', 'Payment gateway configuration missing. Please contact admin.');
        }
    }

    /**
     * Handle successful payment return.
     */
    public function success(Request $request)
    {
        $courseId = $request->get('course_id');
        $sessionId = $request->get('session_id');
        $user = $request->user();
        
        if (!$courseId || !$sessionId) {
            return redirect()->route('dashboard');
        }

        $course = Course::findOrFail($courseId);

        // In a real app, verifying the Stripe session status here is crucial.
        // For this prototype, we assume success if redirected here via the signed/secure flow or just simpler logic.
        
        // Check duplication again
        $exists = Order::where('user_id', $user->id)
            ->where('transaction_id', $sessionId)
            ->exists();

        if ($exists) {
             return redirect()->route('dashboard')->with('success', 'Course already added to your library.');
        }

        // Create Order
        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'completed',
            'total_amount' => $course->price,
            'payment_method' => 'stripe',
            'transaction_id' => $sessionId,
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'course_id' => $course->id,
            'price' => $course->price,
        ]);

        return redirect()->route('dashboard')->with('success', 'Enrollment successful! Start learning now.');
    }
}
