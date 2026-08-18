<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalaryChangeItem extends Model
{
    protected $fillable = [
        'submission_id',
        'nama',
        'nip',

        'gol_baru',
        'istri_suami_baru',
        'anak_baru',
        'gaji_pokok_baru',
        'tunj_struktural_baru',
        'tunj_fungsional_baru',
        'masa_kerja_baru',

        'gol_lama',
        'istri_suami_lama',
        'anak_lama',
        'gaji_pokok_lama',
        'tunj_struktural_lama',
        'tunj_fungsional_lama',
        'masa_kerja_lama',

        'kategori',
        'file_path',
        'file_name',
    ];
    public function submission()
    {
        return $this->belongsTo(
            \App\Models\SalaryChangeSubmission::class,
            'submission_id'
        );
    }
}