<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalaryChangeSubmission extends Model
{
    protected $fillable = [
        'period_id',
        'school_id',
        'type',
        'status',
        'submitted_by',
        'submitted_at',
        'processed_by',
        'processed_at',
    ];

    public function items()
    {
        return $this->hasMany(SalaryChangeItem::class, 'submission_id');
    }

    public function school()
    {
        return $this->belongsTo(\App\Models\School::class);
    }
}