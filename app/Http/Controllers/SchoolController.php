<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SchoolController extends Controller
{
    public function index()
    {
        return Inertia::render('Schools/Index', [
            'schools' => School::orderBy('id')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'official_name' => 'required|string|max:255',
            'school_type' => 'required|in:SMA,SMK,SLB',
        ]);

        $count = School::count() + 1;

        School::create([
            'school_code' => 'SCH-' . str_pad($count, 3, '0', STR_PAD_LEFT),
            'official_name' => strtoupper($validated['official_name']),
            'school_type' => $validated['school_type'],
            'is_active' => true,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Sekolah berhasil ditambahkan.');
    }

    public function toggleActive(School $school)
    {
        $school->update([
            'is_active' => !$school->is_active,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Status sekolah diperbarui.');
    }
}