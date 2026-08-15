<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = [
        'period_id',
        'school_id',
        'status',
        'current_file_id',
        'uploaded_at',
        'approved_at',
        'approved_by',
        'revision_notes',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function files()
    {
        return $this->hasMany(PayrollFile::class);
    }

    public function currentFile()
    {
        return $this->belongsTo(PayrollFile::class, 'current_file_id');
    }
}