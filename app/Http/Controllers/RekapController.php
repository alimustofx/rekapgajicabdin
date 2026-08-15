<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\SalaryPeriod;
use App\Models\SalaryStatus;
use App\Models\Payroll;
use App\Models\PayrollFile;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class RekapController extends Controller
{
    public function index()
    {
        $period = SalaryPeriod::orderByDesc('year')
            ->orderByDesc('month')
            ->first();

        $schools = School::orderBy('id')->get();

        $statuses = SalaryStatus::where('period_id', $period?->id)
            ->get()
            ->groupBy('school_id');

        $payrolls = Payroll::where('period_id', $period?->id)
            ->get()
            ->keyBy('school_id');

        $rows = $schools->map(function ($school) use ($statuses, $payrolls) {
            $schoolStatuses = $statuses->get(
                $school->id,
                collect()
            );

            $pns = $schoolStatuses->firstWhere('type', 'PNS');
            $pppk = $schoolStatuses->firstWhere('type', 'PPPK');

            $payroll = $payrolls->get($school->id);

            return [
                'school' => $school->official_name,
                'pns_status' => $pns->status ?? 'WAITING_DOCUMENT',
                'pppk_status' => $pppk->status ?? 'WAITING_DOCUMENT',
                'payroll_status' => $payroll->status ?? 'BELUM_WAJIB',
                'payroll_id' => $payroll->id ?? null,
            ];
        });

        return Inertia::render('Rekap/Index', [
            'period' => $period,
            'rows' => $rows,
        ]);
    }

    public function downloadPayroll(Payroll $payroll)
    {
        $file = PayrollFile::findOrFail(
            $payroll->current_file_id
        );

        return Storage::download(
            $file->file_path,
            $file->filename
        );
    }

    public function approve(Request $request, Payroll $payroll)
    {
        $payroll->update([
            'status' => 'APPROVED',
            'approved_at' => now(),
            'approved_by' => $request->user()->id,
        ]);

        NotificationService::send(
            NotificationService::operatorsOfSchool($payroll->school_id),
            'PAYROLL_APPROVED',
            'Payroll Disetujui',
            'Payroll periode ini sudah disetujui Cabdin.'
        );

        return redirect()
            ->back()
            ->with('success', 'Payroll disetujui.');
    }

    public function requestRevision(
        Request $request,
        Payroll $payroll
    ) {
        $request->validate([
            'revision_notes' => 'required|string',
        ]);

        $payroll->update([
            'status' => 'REVISION',
            'revision_notes' => $request->revision_notes,
        ]);

        NotificationService::send(
            NotificationService::operatorsOfSchool($payroll->school_id),
            'PAYROLL_REVISION',
            'Payroll Perlu Direvisi',
            $request->revision_notes
        );

        return redirect()
            ->back()
            ->with('success', 'Payroll dikembalikan untuk revisi.');
    }
}
