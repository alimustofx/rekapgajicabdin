<?php

namespace App\Services;

use App\Models\School;

class SchoolMatcher
{
    public static function normalize(string $text): string
    {
        $text = strtoupper($text);
        $text = preg_replace('/[^A-Z0-9 ]/', ' ', $text);
        $text = preg_replace('/([A-Z]+)(\d)/', '$1 $2', $text); // SMAN1 -> SMAN 1
        $text = preg_replace('/\s+/', ' ', $text);

        return trim($text);
    }

    public static function match(string $filename): ?School
    {
        $name = pathinfo($filename, PATHINFO_FILENAME);
        $normalized = self::normalize($name);

        // 1. Exact match ke official_name
        $school = School::whereRaw(
            'UPPER(official_name) = ?',
            [$normalized]
        )->first();

        if ($school) {
            return $school;
        }

        // 2. Cek alias
        $school = School::whereHas('aliases', function ($q) use ($normalized) {
            $q->whereRaw('UPPER(alias) = ?', [$normalized]);
        })->first();

        return $school;
        // null kalau tidak ketemu -> perlu pencocokan manual
    }
}