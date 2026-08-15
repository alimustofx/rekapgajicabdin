<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RevisionRequest extends Model
{
    protected $fillable = [
        'period_id',
        'school_id',
        'type',
        'salary_document_id',
        'category',
        'description',
        'status',
        'created_by',
        'resolved_at',
        'resolved_by',
    ];

    public function school()
    {
        return $this->belongsTo(\App\Models\School::class);
    }

    public function creator()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function document()
    {
        return $this->belongsTo(
            \App\Models\SalaryDocument::class,
            'salary_document_id'
        );
    }
}