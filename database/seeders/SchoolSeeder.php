<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schools = [
            'SMAN 1 Sumbermanjing',
            'SMAN 1 Bululawang',
            'SMAN 1 Turen',
            'SMKN 1 Gedangan',
            'SMAN 1 Gondanglegi',
            'SMAN 1 Lawang',
            'SMAN 1 Kepanjen',
            'SMKN 2 Turen',
            'SMAN 1 Pagak',
            'SMKN 1 Turen',
            'SMAN 1 Ngantang',
            'SMKN 1 Ampelgading',
            'SMAN 1 Dampit',
            'SMAN 1 Singosari',
            'SMAN 1 Bantur',
            'SMKN 1 Singosari',
            'SMAN 1 Sumberpucung',
            'SLBN Pembina Malang',
            'SMKN 1 Pujon',
            'SMKN 1 Kepanjen',
            'SMKN 2 Singosari',
            'SMKN 1 Wonosari',
            'SMAN 1 Tumpang',
        ];

        foreach ($schools as $index => $name) {
            \App\Models\School::create([
                'school_code' => 'SCH-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'official_name' => strtoupper($name),
                'school_type' => str_starts_with(strtoupper($name), 'SMK')
                    ? 'SMK'
                    : (str_starts_with(strtoupper($name), 'SLB') ? 'SLB' : 'SMA'),
                'is_active' => true,
            ]);
        }
    }
}