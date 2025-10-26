<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Payment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $user = $request->user();

        // Get the active application (completed one)
        $activeApplication = Application::where('user_id', $user->id)
            ->where('status', 'completed')
            ->with(['latestPayment'])
            ->latest()
            ->first();

        // Get all payments for the user
        $payments = Payment::whereHas('application', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->with(['application'])
            ->latest()
            ->get();

        // Calculate totals
        $totalFees = 0;
        $totalPaid = 0;
        $paymentBreakdown = [];

        if ($activeApplication) {
            // Get payment items from the latest payment if it exists
            if ($activeApplication->latestPayment && $activeApplication->latestPayment->payment_items) {
                $paymentBreakdown = $activeApplication->latestPayment->payment_items;
                foreach ($paymentBreakdown as $item) {
                    $totalFees += $item['amount'] ?? 0;
                }
            }

            // Calculate total paid from verified/paid payments
            $paidAmount = $payments->where('status', 'paid')->sum('total_amount');
            $totalPaid = $paidAmount;
        }

        $balanceDue = $totalFees - $totalPaid;

        return view('driver.payments.index', compact(
            'activeApplication',
            'payments',
            'totalFees',
            'totalPaid',
            'balanceDue',
            'paymentBreakdown'
        ));
    }

    public function show(Payment $payment)
    {
        // Verify the payment belongs to the current user's application
        $this->authorize('view', $payment);

        $payment->load(['application', 'createdBy', 'verifiedBy', 'cancelledBy']);

        return view('driver.payments.show', compact('payment'));
    }
}
