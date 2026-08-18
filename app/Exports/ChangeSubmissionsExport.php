<?php

namespace App\Exports;

use App\Models\SalaryChangeSubmission;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ChangeSubmissionsExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(protected int $periodId)
    {
    }

    public function collection(): \Illuminate\Support\Collection
    {
        return SalaryChangeSubmission::with(['items', 'school'])
            ->where('period_id', $this->periodId)
            ->get()
            ->flatMap(function ($submission) {
                if ($submission->items->isEmpty()) {
                    return [[
                        'school' => $submission->school->official_name,
                        'type' => $submission->type,
                        'status' => $submission->status,
                        'item' => null,
                    ]];
                }

                return $submission->items->map(fn ($item) => [
                    'school' => $submission->school->official_name,
                    'type' => $submission->type,
                    'status' => $submission->status,
                    'item' => $item,
                ]);
            });
    }

    public function headings(): array
    {
        return [
            'Sekolah',
            'Jenis',
            'Status',
            'Nama',
            'NIP',
            'Kategori',
            'Gol Lama',
            'Gol Baru',
            'Istri/Suami Lama',
            'Istri/Suami Baru',
            'Anak Lama',
            'Anak Baru',
            'Gaji Pokok Lama',
            'Gaji Pokok Baru',
            'Tunj. Struktural Lama',
            'Tunj. Struktural Baru',
            'Tunj. Fungsional Lama',
            'Tunj. Fungsional Baru',
            'Masa Kerja Lama',
            'Masa Kerja Baru',
        ];
    }

    public function map($row): array
    {
        $item = $row['item'];

        $statusLabel = $row['status'] === 'NO_CHANGE'
            ? 'Tidak Ada Perubahan'
            : $row['status'];

        if (!$item) {
            return [
                $row['school'],
                $row['type'],
                $statusLabel,
                '-',
                '-',
                'Tidak Ada Perubahan',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
            ];
        }

        return [
            $row['school'],
            $row['type'],
            $statusLabel,
            $item->nama,
            $item->nip,
            $item->kategori,
            $item->gol_lama,
            $item->gol_baru,
            $item->istri_suami_lama,
            $item->istri_suami_baru,
            $item->anak_lama,
            $item->anak_baru,
            $item->gaji_pokok_lama,
            $item->gaji_pokok_baru,
            $item->tunj_struktural_lama,
            $item->tunj_struktural_baru,
            $item->tunj_fungsional_lama,
            $item->tunj_fungsional_baru,
            $item->masa_kerja_lama,
            $item->masa_kerja_baru,
        ];
    }
}