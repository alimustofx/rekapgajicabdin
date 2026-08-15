<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SchoolAlias;

class School extends Model
{
    protected $fillable = [
        'school_code',
        'official_name',
        'school_type',
        'is_active',
    ];

    public function aliases()
    {
        return $this->hasMany(SchoolAlias::class);
    }
}