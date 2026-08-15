<?php

namespace App\Http\Controllers;

use App\Models\SalaryDocument;
use App\Models\SalaryStatus;
use App\Models\RevisionRequest;
use App\Models\Payroll;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class DocumentController extends Controller
{
    private function authorizeAccess(
        Request $request,
        SalaryDocument $document
    ) {
        $user = $request->user();

        if (
            $user->role === 'OPERATOR' &&
            $document->school_id !== $user->school_id
        ) {
            abort(403, 'Dokumen ini bukan milik sekolah Anda.');
        }
    }

    public function show(
        Request $request,
        SalaryDocument $document
    ) {
        $this->authorizeAccess($request, $document);

        $status = SalaryStatus::where(
            'current_document_id',
            $document->id
        )->first();

        return Inertia::render('Documents/Show', [
            'document' => $document,
            'status' => $status,
        ]);
    }

    public function download(
        Request $request,
        SalaryDocument $document
    ) {
        $this->authorizeAccess($request, $document);

        return Storage::download(
            $document->file_path,
            $document->filename
        );
    }

    public function fix(
        Request $request,
        SalaryDocument $document
    ) {
        $this->authorizeAccess($request, $document);

        /*
        |--------------------------------------------------------------------------
        | 1. Ubah status dokumen menjadi FIX
        |--------------------------------------------------------------------------
        */

        SalaryStatus::where(
            'current_document_id',
            $document->id
        )->update([
            'status' => 'FIX',
            'fixed_at' => now(),
            'fixed_by' => $request->user()->id,
        ]);

        /*
        |--------------------------------------------------------------------------
        | 2. Ambil status dokumen setelah diubah menjadi FIX
        |--------------------------------------------------------------------------
        */

        $status = SalaryStatus::where(
            'current_document_id',
            $document->id
        )->first();

        /*
        |--------------------------------------------------------------------------
        | 3. Pastikan SalaryStatus ditemukan
        |--------------------------------------------------------------------------
        */

        if ($status) {

            /*
            |--------------------------------------------------------------------------
            | 4. Cek apakah PNS sudah FIX
            |--------------------------------------------------------------------------
            */

            $pnsFix = SalaryStatus::where(
                'period_id',
                $status->period_id
            )
                ->where(
                    'school_id',
                    $document->school_id
                )
                ->where(
                    'type',
                    'PNS'
                )
                ->where(
                    'status',
                    'FIX'
                )
                ->exists();

            /*
            |--------------------------------------------------------------------------
            | 5. Cek apakah PPPK sudah FIX
            |--------------------------------------------------------------------------
            */

            $pppkFix = SalaryStatus::where(
                'period_id',
                $status->period_id
            )
                ->where(
                    'school_id',
                    $document->school_id
                )
                ->where(
                    'type',
                    'PPPK'
                )
                ->where(
                    'status',
                    'FIX'
                )
                ->exists();

            /*
            |--------------------------------------------------------------------------
            | 6. Jika PNS DAN PPPK sama-sama FIX
            |--------------------------------------------------------------------------
            */

            if ($pnsFix && $pppkFix) {

                /*
                |--------------------------------------------------------------------------
                | Cek apakah Payroll sudah ada
                |--------------------------------------------------------------------------
                */

                $payroll = Payroll::firstOrCreate(
                    [
                        'period_id' => $status->period_id,
                        'school_id' => $document->school_id,
                    ],
                    [
                        'status' => 'REQUIRED',
                    ]
                );

                /*
                |--------------------------------------------------------------------------
                | 7. Kirim notifikasi hanya jika Payroll baru dibuat
                |--------------------------------------------------------------------------
                */

                if ($payroll->wasRecentlyCreated) {
                    NotificationService::send(
                        NotificationService::operatorsOfSchool(
                            $document->school_id
                        ),
                        'PAYROLL_REQUIRED',
                        'Payroll Perlu Dibuat',
                        'PNS & PPPK sudah FIX, segera buat payroll.'
                    );
                }
            }
        }

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Dokumen dikonfirmasi FIX.'
            );
    }

    public function requestRevision(
        Request $request,
        SalaryDocument $document
    ) {
        $this->authorizeAccess(
            $request,
            $document
        );

        /*
        |--------------------------------------------------------------------------
        | 1. Validasi permintaan perbaikan
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'category' => 'required|string',
            'description' => 'required|string|min:5',
        ]);

        /*
        |--------------------------------------------------------------------------
        | 2. Ambil period_id dari SalaryStatus
        |--------------------------------------------------------------------------
        */

        $periodId = SalaryStatus::where(
            'current_document_id',
            $document->id
        )->value('period_id');

        /*
        |--------------------------------------------------------------------------
        | 3. Buat RevisionRequest
        |--------------------------------------------------------------------------
        */

        RevisionRequest::create([
            'period_id' => $periodId,
            'school_id' => $document->school_id,
            'type' => $document->type,
            'salary_document_id' => $document->id,
            'category' => $validated['category'],
            'description' => $validated['description'],
            'status' => 'OPEN',
            'created_by' => $request->user()->id,
        ]);

        /*
        |--------------------------------------------------------------------------
        | 4. Kirim notifikasi ke Admin
        |--------------------------------------------------------------------------
        */

        NotificationService::send(
            NotificationService::admins(),
            'REVISION_REQUESTED',
            'Permintaan Perbaikan Baru',
            $document->type . ' - ' . (
                $document->school->official_name ?? 'Sekolah'
            )
        );

        /*
        |--------------------------------------------------------------------------
        | 5. Ubah status dokumen menjadi NEEDS_REVISION
        |--------------------------------------------------------------------------
        */

        SalaryStatus::where(
            'current_document_id',
            $document->id
        )->update([
            'status' => 'NEEDS_REVISION',
        ]);

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Permintaan perbaikan terkirim ke Cabdin.'
            );
    }
}