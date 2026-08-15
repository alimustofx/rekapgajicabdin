<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SalaryDocument;

class SalaryStatus extends Model
{
    protected $fillable = [
        'period_id',
        'school_id',
        'type',
        'status',
        'current_document_id',
        'fixed_at',
        'fixed_by',
    ];

    public function currentDocument()
    {
        return $this->belongsTo(
            SalaryDocument::class,
            'current_document_id'
        );
    }
}