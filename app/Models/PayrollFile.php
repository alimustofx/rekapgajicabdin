<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollFile extends Model
{
    protected $fillable = [
        'payroll_id',
        'filename',
        'file_path',
        'version',
        'uploaded_by',
    ];
}