<?php

namespace App\Http\Controllers\Sb;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Payment;
use App\Models\Inspection;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        // Application Statistics
        $applicationStats = [
            'total' => Application::count(),
            'completed' => Application::where('status', 'completed')->count(),
            'pending' => Application::whereIn('status', ['pending_review', 'incomplete', 'for_scheduling'])->count(),
            'approved' => Application::where('status', 'approved')->count(),
            'rejected' => Application::where('status', 'rejected')->count(),
            'renewal' => Application::where('status', 'for_renewal')->count(),
        ];

        // Payment Statistics
        $paymentStats = [
            'total' => Payment::sum('total_amount') ?? 0,
            'verified' => Payment::where('status', 'verified')->sum('total_amount') ?? 0,
            'pending' => Payment::where('status', 'pending')->sum('total_amount') ?? 0,
            'count' => Payment::count(),
        ];

        // Inspection Statistics
        $inspectionStats = [
            'total' => Inspection::count(),
            'completed' => Inspection::where('status', 'completed')->count(),
            'scheduled' => Inspection::where('status', 'scheduled')->count(),
            'passed' => Inspection::where('result', 'passed')->count(),
            'failed' => Inspection::where('result', 'failed')->count(),
        ];

        // Monthly Application Trend (last 12 months)
        $monthlyTrend = Application::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function ($item) {
                return [
                    'month' => \Carbon\Carbon::createFromFormat('Y-m', $item->month)->format('M Y'),
                    'count' => $item->count,
                ];
            });

        // Application Status Distribution
        $statusDistribution = Application::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get()
            ->map(function ($item) {
                return [
                    'status' => ucfirst(str_replace('_', ' ', $item->status)),
                    'count' => $item->count,
                ];
            });

        // Inspection Results Distribution
        $inspectionResults = Inspection::selectRaw('result, COUNT(*) as count')
            ->whereNotNull('result')
            ->groupBy('result')
            ->get()
            ->map(function ($item) {
                return [
                    'result' => ucfirst($item->result),
                    'count' => $item->count,
                ];
            });

        return view('sb.reports.index', compact(
            'applicationStats',
            'paymentStats',
            'inspectionStats',
            'monthlyTrend',
            'statusDistribution',
            'inspectionResults'
        ));
    }

    public function show($report_type = 'summary')
    {
        // Detailed report view
        $data = [];

        switch ($report_type) {
            case 'applications':
                $data['applications'] = Application::with('user')->latest()->paginate(25);
                $data['title'] = 'Application Reports';
                break;

            case 'payments':
                $data['payments'] = Payment::with('application.user')->latest()->paginate(25);
                $data['title'] = 'Payment Reports';
                break;

            case 'inspections':
                $data['inspections'] = Inspection::with('application.user')->latest()->paginate(25);
                $data['title'] = 'Inspection Reports';
                break;

            default:
                $data['title'] = 'Summary Report';
        }

        return view('sb.reports.show', array_merge($data, ['report_type' => $report_type]));
    }
}
