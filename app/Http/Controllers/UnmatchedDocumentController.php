<?php

namespace App\Http\Controllers;

use App\Models\SalaryDocument;
use App\Models\SalaryStatus;
use App\Models\School;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UnmatchedDocumentController extends Controller
{
    public function index()
    {
        return Inertia::render('UnmatchedDocuments/Index', [
            'documents' => SalaryDocument::with('import.period')
                ->where('is_matched', false)
                ->where('is_ignored', false)
                ->latest()
                ->get(),

            'schools' => School::orderBy('official_name')
                ->get(['id', 'official_name']),
        ]);
    }

    public function assign(
        Request $request,
        SalaryDocument $document
    ) {
        $validated = $request->validate([
            'school_id' => 'required|exists:schools,id',
        ]);

        $document->update([
            'school_id' => $validated['school_id'],
            'is_matched' => true,
        ]);

        SalaryStatus::updateOrCreate(
            [
                'period_id' => $document->import->period_id,
                'school_id' => $validated['school_id'],
                'type' => $document->type,
            ],
            [
                'status' => 'WAITING_VERIFICATION',
                'current_document_id' => $document->id,
            ]
        );

        NotificationService::send(
            NotificationService::operatorsOfSchool($validated['school_id']),
            'DOCUMENT_AVAILABLE',
            'Dokumen Gaji Tersedia',
            $document->type . ' sudah tersedia untuk diverifikasi.'
        );

        return redirect()
            ->back()
            ->with('success', 'Dokumen berhasil dicocokkan.');
    }

    public function ignore(SalaryDocument $document)
    {
        $document->update([
            'is_ignored' => true,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Dokumen diabaikan.');
    }
}