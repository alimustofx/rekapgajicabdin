<?php

namespace App\Http\Controllers;

use App\Models\SalaryDocument;
use App\Models\SalaryImport;
use App\Models\SalaryPeriod;
use App\Models\SalaryStatus;
use App\Services\SchoolMatcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use ZipArchive;

class ImportController extends Controller
{
    public function index()
    {
        return Inertia::render('Imports/Index', [
            'periods' => SalaryPeriod::orderByDesc('year')
                ->orderByDesc('month')
                ->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'period_id' => 'required|exists:salary_periods,id',
            'type' => 'required|in:PNS,PPPK',
            'zip_file' => 'required|file|mimes:zip|max:51200',
        ]);

        $zipPath = $request->file('zip_file')->store('imports/raw');

        $import = SalaryImport::create([
            'period_id' => $validated['period_id'],
            'type' => $validated['type'],
            'zip_filename' => $request->file('zip_file')->getClientOriginalName(),
            'zip_path' => $zipPath,
            'uploaded_by' => $request->user()->id,
            'status' => 'PROCESSING',
        ]);

        $matched = 0;
        $unmatched = 0;
        $total = 0;

        $zip = new ZipArchive();

        $fullZipPath = Storage::path($zipPath);
        $extractFolder = 'imports/extracted/' . $import->id;

        if ($zip->open($fullZipPath) === true) {
            $zip->extractTo(Storage::path($extractFolder));
            $zip->close();

            $files = Storage::allFiles($extractFolder);

            foreach ($files as $filePath) {
                $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

                if (!in_array($ext, ['xlsx', 'xls'])) {
                    continue;
                }

                $total++;

                $filename = basename($filePath);
                $school = SchoolMatcher::match($filename);

                $doc = SalaryDocument::create([
                    'import_id' => $import->id,
                    'school_id' => $school?->id,
                    'type' => $validated['type'],
                    'filename' => $filename,
                    'file_path' => $filePath,
                    'version' => 1,
                    'is_current' => true,
                    'is_matched' => (bool) $school,
                    'uploaded_by' => $request->user()->id,
                ]);

                if ($school) {
                    $matched++;

                    SalaryStatus::updateOrCreate(
                        [
                            'period_id' => $validated['period_id'],
                            'school_id' => $school->id,
                            'type' => $validated['type'],
                        ],
                        [
                            'status' => 'WAITING_VERIFICATION',
                            'current_document_id' => $doc->id,
                        ]
                    );
                } else {
                    $unmatched++;
                }
            }
        }

        $import->update([
            'status' => 'DONE',
        ]);

        return redirect()->back()->with('summary', [
            'total' => $total,
            'matched' => $matched,
            'unmatched' => $unmatched,
        ]);
    }
}