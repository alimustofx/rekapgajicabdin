<?php

namespace App\Http\Controllers;

use App\Models\SalaryPeriod;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SalaryPeriodController extends Controller
{
    public function index()
    {
        return Inertia::render('Periods/Index', [
            'periods' => SalaryPeriod::orderByDesc('year')
                ->orderByDesc('month')
                ->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2024|max:2100',
        ]);

        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        SalaryPeriod::create([
            'month' => $validated['month'],
            'year' => $validated['year'],
            'label' => $bulan[$validated['month']] . ' ' . $validated['year'],
            'status' => 'OPEN',
        ]);

        return redirect()->back()->with(
            'success',
            'Periode berhasil dibuat.'
        );
    }

    public function toggleStatus(\App\Models\SalaryPeriod $period)
    {
        $period->update([
            'status' => $period->status === 'OPEN' ? 'CLOSED' : 'OPEN',
        ]);

        return redirect()
            ->back()
            ->with('success', 'Status periode diperbarui.');
    }
}