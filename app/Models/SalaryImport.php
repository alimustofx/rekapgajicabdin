<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalaryImport extends Model
{
    protected $fillable = [
        'period_id',
        'type',
        'zip_filename',
        'zip_path',
        'uploaded_by',
        'status',
    ];

    public function period()
    {
        return $this->belongsTo(
            \App\Models\SalaryPeriod::class,
            'period_id'
        );
    }
}