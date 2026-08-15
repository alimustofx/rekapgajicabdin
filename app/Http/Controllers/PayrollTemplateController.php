<?php

namespace App\Http\Controllers;

use App\Models\PayrollTemplate;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PayrollTemplateController extends Controller
{
    public function index()
    {
        return Inertia::render('PayrollTemplates/Index', [
            'templates' => PayrollTemplate::latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:10240',
            'name' => 'required|string',
        ]);

        PayrollTemplate::where('is_active', true)
            ->update([
                'is_active' => false,
            ]);

        PayrollTemplate::create([
            'name' => $request->name,
            'file_path' => $request->file('file')->store('payroll-templates'),
            'is_active' => true,
            'created_by' => $request->user()->id,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Template payroll diperbarui.');
    }

    public function download(PayrollTemplate $payrollTemplate)
    {
        return \Illuminate\Support\Facades\Storage::download(
            $payrollTemplate->file_path,
            $payrollTemplate->name
        );
    }
}