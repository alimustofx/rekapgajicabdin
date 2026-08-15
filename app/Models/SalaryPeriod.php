<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalaryPeriod extends Model
{
    protected $fillable = [
        'month',
        'year',
        'label',
        'status',
    ];
}