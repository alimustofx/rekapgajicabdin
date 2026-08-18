<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\PayrollFile;
use App\Models\PayrollTemplate;
use App\Models\SalaryPeriod;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PayrollController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();

        $period = SalaryPeriod::orderByDesc('year')
            ->orderByDesc('month')
            ->first();

        $payroll = Payroll::where('school_id', $user->school_id)
            ->where('period_id', $period?->id)
            ->first();

        return Inertia::render('Payroll/Show', [
            'payroll' => $payroll,
            'template' => PayrollTemplate::where('is_active', true)->first(),
        ]);
    }

    public function upload(Request $request, Payroll $payroll)
    {
        if (
            $request->user()->role === 'OPERATOR' &&
            $payroll->school_id !== $request->user()->school_id
        ) {
            abort(403);
        }

        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:10240',
        ]);

        $file = PayrollFile::create([
            'payroll_id' => $payroll->id,
            'filename' => $request->file('file')->getClientOriginalName(),
            'file_path' => $request->file('file')->store(
                'payroll-files/' . $payroll->school_id
            ),
            'version' => $payroll->files()->count() + 1,
            'uploaded_by' => $request->user()->id,
        ]);

        $payroll->update([
            'status' => 'UPLOADED',
            'current_file_id' => $file->id,
            'uploaded_at' => now(),
            'revision_notes' => null,
        ]);
        NotificationService::send(
            NotificationService::admins(),
            'PAYROLL_UPLOADED',
            'Payroll Diupload',
            'Menunggu review untuk sekolah ini.'
        );

        return redirect()
            ->back()
            ->with('success', 'Payroll berhasil diupload, menunggu review Cabdin.');
    }
}