<?php

namespace App\Http\Controllers;

use App\Models\SalaryChangeSubmission;
use App\Models\SalaryPeriod;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SalaryChangeController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $period = SalaryPeriod::orderByDesc('year')
            ->orderByDesc('month')
            ->first();

        $pns = SalaryChangeSubmission::where('period_id', $period?->id)
            ->where('school_id', $user->school_id)
            ->where('type', 'PNS')
            ->first();

        $pppk = SalaryChangeSubmission::where('period_id', $period?->id)
            ->where('school_id', $user->school_id)
            ->where('type', 'PPPK')
            ->first();

        return Inertia::render('ChangeSubmissions/Index', [
            'period' => $period,
            'pns' => $pns,
            'pppk' => $pppk,
        ]);
    }

    public function create(string $type)
    {
        return Inertia::render('ChangeSubmissions/Create', [
            'type' => strtoupper($type),
        ]);
    }

    public function noChange(Request $request, string $type)
    {
        $period = SalaryPeriod::orderByDesc('year')
            ->orderByDesc('month')
            ->first();

        SalaryChangeSubmission::updateOrCreate(
            [
                'period_id' => $period->id,
                'school_id' => $request->user()->school_id,
                'type' => strtoupper($type),
            ],
            [
                'status' => 'NO_CHANGE',
                'submitted_by' => $request->user()->id,
                'submitted_at' => now(),
            ]
        );

        return redirect()
            ->route('change-submissions.index')
            ->with('success', 'Dikonfirmasi tidak ada perubahan.');
    }

    public function store(Request $request, string $type)
    {
        $type = strtoupper($type);

        $validated = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.nama' => 'required|string',
            'items.*.nip' => 'required|string',
            'items.*.kategori' => 'required|string',
            'items.*.file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $period = SalaryPeriod::orderByDesc('year')
            ->orderByDesc('month')
            ->first();

        $submission = SalaryChangeSubmission::updateOrCreate(
            [
                'period_id' => $period->id,
                'school_id' => $request->user()->school_id,
                'type' => $type,
            ],
            [
                'status' => 'SUBMITTED',
                'submitted_by' => $request->user()->id,
                'submitted_at' => now(),
            ]
        );

        foreach ($request->file('items') as $index => $files) {
            $file = $files['file'];

            $path = $file->store(
                'sk-perubahan/' . $submission->id
            );

            $submission->items()->create([
                'nama' => $validated['items'][$index]['nama'],
                'nip' => $validated['items'][$index]['nip'],

                'gol_baru' => $request->input(
                    "items.$index.gol_baru"
                ),

                'istri_suami_baru' => $request->input(
                    "items.$index.istri_suami_baru"
                ),

                'anak_baru' => $request->input(
                    "items.$index.anak_baru"
                ),

                'gaji_pokok_baru' => $request->input(
                    "items.$index.gaji_pokok_baru"
                ),

                'tunj_struktural_baru' => $request->input(
                    "items.$index.tunj_struktural_baru"
                ),

                'tunj_fungsional_baru' => $request->input(
                    "items.$index.tunj_fungsional_baru"
                ),

                'masa_kerja_baru' => $request->input(
                    "items.$index.masa_kerja_baru"
                ),

                'gol_lama' => $request->input(
                    "items.$index.gol_lama"
                ),

                'istri_suami_lama' => $request->input(
                    "items.$index.istri_suami_lama"
                ),

                'anak_lama' => $request->input(
                    "items.$index.anak_lama"
                ),

                'gaji_pokok_lama' => $request->input(
                    "items.$index.gaji_pokok_lama"
                ),

                'tunj_struktural_lama' => $request->input(
                    "items.$index.tunj_struktural_lama"
                ),

                'tunj_fungsional_lama' => $request->input(
                    "items.$index.tunj_fungsional_lama"
                ),

                'masa_kerja_lama' => $request->input(
                    "items.$index.masa_kerja_lama"
                ),

                'kategori' => $validated['items'][$index]['kategori'],

                'file_path' => $path,

                'file_name' => $file->getClientOriginalName(),
            ]);
        }

        NotificationService::send(
            NotificationService::admins(),
            'CHANGE_SUBMITTED',
            'Pengajuan Perubahan Gaji Baru',
            $type . ' - ' . count($validated['items']) . ' pegawai'
        );

        return redirect()
            ->route('change-submissions.index')
            ->with('success', 'Pengajuan berhasil dikirim.');
    }
}