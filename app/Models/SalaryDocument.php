<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalaryDocument extends Model
{
    protected $fillable = [
        'import_id',
        'school_id',
        'type',
        'filename',
        'file_path',
        'version',
        'is_current',
        'is_matched',
        'is_ignored',
        'uploaded_by',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function import()
    {
        return $this->belongsTo(SalaryImport::class, 'import_id');
    }
}