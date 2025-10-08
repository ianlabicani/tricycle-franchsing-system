<?php

namespace App\Http\Controllers\Sb;

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
        $status = $request->get('status', 'all');
        $search = $request->get('search');

        $query = Payment::with(['application.user'])->latest();

        // Apply search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('payment_no', 'like', '%'.$search.'%')
                    ->orWhereHas('application', function ($subQ) use ($search) {
                        $subQ->where('application_no', 'like', '%'.$search.'%')
                            ->orWhereHas('user', function ($userQ) use ($search) {
                                $userQ->where('name', 'like', '%'.$search.'%')
                                    ->orWhere('email', 'like', '%'.$search.'%');
                            });
                    });
            });
        }

        // Apply status filter
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $payments = $query->paginate(15)->appends([
            'status' => $status,
            'search' => $search,
        ]);

        // Statistics
        $stats = [
            'total' => Payment::count(),
            'pending' => Payment::where('status', 'pending')->count(),
            'paid' => Payment::where('status', 'paid')->count(),
            'total_amount' => Payment::where('status', 'paid')->sum('total_amount'),
        ];

        return view('sb.payments.index', compact('payments', 'stats', 'status'));
    }

    public function create(Request $request)
    {
        $applicationId = $request->get('application_id');
        $application = null;

        if ($applicationId) {
            $application = Application::with(['user', 'latestInspection'])->findOrFail($applicationId);

            // Check if application has passed inspection
            if ($application->status !== 'for_treasury') {
                return redirect()->route('sb.applications.show', $application)
                    ->with('error', 'Application must pass inspection before creating payment record.');
            }

            // Check if payment already exists
            if ($application->latestPayment && $application->latestPayment->status === 'pending') {
                return redirect()->route('sb.payments.show', $application->latestPayment)
                    ->with('info', 'A pending payment record already exists for this application.');
            }
        }

        return view('sb.payments.create', compact('application'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'application_id' => 'required|exists:applications,id',
            'payment_items' => 'required|array|min:1',
            'payment_items.*.name' => 'required|string|max:255',
            'payment_items.*.amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string|max:500',
        ]);

        $application = Application::findOrFail($request->application_id);

        // Check if application is in correct status
        if ($application->status !== 'for_treasury') {
            return redirect()->route('sb.applications.show', $application)
                ->with('error', 'Application must pass inspection before creating payment record.');
        }

        // Calculate total amount
        $totalAmount = collect($request->payment_items)->sum('amount');

        $payment = Payment::create([
            'application_id' => $request->application_id,
            'payment_items' => $request->payment_items,
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'notes' => $request->notes,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('sb.payments.show', $payment)
            ->with('success', 'Payment record created successfully. Payment No: '.$payment->payment_no);
    }

    public function show(Payment $payment)
    {
        $payment->load(['application.user', 'createdBy', 'verifiedBy']);

        return view('sb.payments.show', compact('payment'));
    }

    public function verify(Request $request, Payment $payment)
    {
        $request->validate([
            'paid_at' => 'required|date|before_or_equal:now',
        ]);

        if ($payment->status !== 'pending') {
            return redirect()->route('sb.payments.show', $payment)
                ->with('error', 'Only pending payments can be verified.');
        }

        $payment->update([
            'status' => 'paid',
            'paid_at' => $request->paid_at,
            'verified_at' => now(),
            'verified_by' => $request->user()->id,
        ]);

        // Update application status to for_approval
        $application = $payment->application;
        $application->update([
            'status' => 'for_approval',
        ]);

        return redirect()->route('sb.payments.show', $payment)
            ->with('success', 'Payment verified successfully. Application is now for approval.');
    }

    public function cancel(Request $request, Payment $payment)
    {
        $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        if ($payment->status !== 'pending') {
            return redirect()->route('sb.payments.show', $payment)
                ->with('error', 'Only pending payments can be cancelled.');
        }

        $payment->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
            'cancelled_by' => auth()->id(),
            'notes' => ($payment->notes ? $payment->notes."\n\n" : '').'Cancellation Reason: '.$request->reason,
        ]);

        return redirect()->route('sb.payments.show', $payment)
            ->with('success', 'Payment cancelled successfully.');
    }
}
