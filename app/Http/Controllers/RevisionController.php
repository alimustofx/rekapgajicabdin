<?php

namespace App\Http\Controllers;

use App\Models\RevisionRequest;
use App\Models\SalaryDocument;
use App\Models\SalaryStatus;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RevisionController extends Controller
{
    public function index()
    {
        return Inertia::render('Revisions/Index', [
            'requests' => RevisionRequest::with(['school', 'creator'])
                ->where('status', 'OPEN')
                ->latest()
                ->get(),
        ]);
    }

    public function show(RevisionRequest $revisionRequest)
    {
        $revisionRequest->load([
            'school',
            'creator',
            'document',
        ]);

        return Inertia::render('Revisions/Show', [
            'revisionRequest' => $revisionRequest,
        ]);
    }

    public function resolve(
        Request $request,
        RevisionRequest $revisionRequest
    ) {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:10240',
        ]);

        $oldDocument = SalaryDocument::findOrFail(
            $revisionRequest->salary_document_id
        );

        $path = $request->file('file')->store(
            'documents/' . $oldDocument->school_id
        );

        $newDocument = SalaryDocument::create([
            'import_id' => $oldDocument->import_id,
            'school_id' => $oldDocument->school_id,
            'type' => $oldDocument->type,
            'filename' => $request->file('file')->getClientOriginalName(),
            'file_path' => $path,
            'version' => $oldDocument->version + 1,
            'is_current' => true,
            'is_matched' => true,
            'uploaded_by' => $request->user()->id,
        ]);

        $oldDocument->update([
            'is_current' => false,
        ]);

        SalaryStatus::where(
            'school_id',
            $oldDocument->school_id
        )
            ->where('type', $oldDocument->type)
            ->update([
                'status' => 'WAITING_REVERIFICATION',
                'current_document_id' => $newDocument->id,
            ]);

        $revisionRequest->update([
            'status' => 'RESOLVED',
            'resolved_at' => now(),
            'resolved_by' => $request->user()->id,
        ]);
        NotificationService::send(
            NotificationService::operatorsOfSchool($oldDocument->school_id),
            'REVISION_AVAILABLE',
            'File Revisi Tersedia',
            $oldDocument->type . ' sudah diperbarui, silakan cek ulang.'
        );

        return redirect()
            ->route('revisions.index')
            ->with('success', 'Revisi berhasil dikirim ke operator.');
    }
}