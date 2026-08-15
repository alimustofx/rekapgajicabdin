<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\RevisionRequest;
use App\Models\SalaryPeriod;
use App\Models\SalaryStatus;
use App\Models\School;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $period = SalaryPeriod::orderByDesc('year')
            ->orderByDesc('month')
            ->first();

        $statuses = collect();
        $stats = null;

        /*
        |--------------------------------------------------------------------------
        | Dashboard Operator
        |--------------------------------------------------------------------------
        */

        if (
            $user->role === 'OPERATOR' &&
            $user->school_id &&
            $period
        ) {
            $statuses = SalaryStatus::with('currentDocument')
                ->where('school_id', $user->school_id)
                ->where('period_id', $period->id)
                ->get();
        }

        /*
        |--------------------------------------------------------------------------
        | Dashboard Admin
        |--------------------------------------------------------------------------
        */

        if ($user->role !== 'OPERATOR' && $period) {

            $totalSchools = School::where('is_active', true)
                ->count();

            $stats = [
                'total_schools' => $totalSchools,

                'pns_fix' => SalaryStatus::where('period_id', $period->id)
                    ->where('type', 'PNS')
                    ->where('status', 'FIX')
                    ->count(),

                'pppk_fix' => SalaryStatus::where('period_id', $period->id)
                    ->where('type', 'PPPK')
                    ->where('status', 'FIX')
                    ->count(),

                'payroll_required' => Payroll::where('period_id', $period->id)
                    ->where('status', 'REQUIRED')
                    ->count(),

                'payroll_uploaded' => Payroll::where('period_id', $period->id)
                    ->where('status', 'UPLOADED')
                    ->count(),

                'payroll_approved' => Payroll::where('period_id', $period->id)
                    ->where('status', 'APPROVED')
                    ->count(),

                'payroll_revision' => Payroll::where('period_id', $period->id)
                    ->where('status', 'REVISION')
                    ->count(),

                'open_revisions' => RevisionRequest::where('status', 'OPEN')
                    ->count(),
            ];
        }

        return Inertia::render('Dashboard', [
            'period' => $period,
            'statuses' => $statuses,
            'stats' => $stats,
        ]);
    }
}