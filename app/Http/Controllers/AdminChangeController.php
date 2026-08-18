<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\SalaryChangeItem;
use App\Models\SalaryChangeSubmission;
use App\Models\SalaryPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AdminChangeController extends Controller
{
    public function index()
    {
        $period = SalaryPeriod::orderByDesc('year')
            ->orderByDesc('month')
            ->first();

        $schools = School::where('is_active', true)
            ->orderBy('official_name')
            ->get();

        $subs = SalaryChangeSubmission::where(
            'period_id',
            $period?->id
        )
            ->get()
            ->groupBy('school_id');

        $rows = $schools->map(function ($school) use ($subs) {
            $schoolSubs = $subs->get(
                $school->id,
                collect()
            );

            return [
                'school' => $school->official_name,
                'pns' => $schoolSubs->firstWhere('type', 'PNS'),
                'pppk' => $schoolSubs->firstWhere('type', 'PPPK'),
            ];
        });

        return Inertia::render(
            'Admin/ChangeSubmissions/Index',
            [
                'period' => $period,
                'rows' => $rows,
            ]
        );
    }

    public function show(
        SalaryChangeSubmission $submission
    ) {
        $submission->load([
            'items',
            'school',
        ]);

        return Inertia::render(
            'Admin/ChangeSubmissions/Show',
            [
                'submission' => $submission,
            ]
        );
    }

    public function process(
        SalaryChangeSubmission $submission,
        Request $request
    ) {
        $submission->update([
            'status' => 'PROCESSED',
            'processed_by' => $request->user()->id,
            'processed_at' => now(),
        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                'Ditandai sudah diproses.'
            );
    }

    public function downloadItem(
        SalaryChangeItem $item
    ) {
        return Storage::download(
            $item->file_path,
            $item->file_name
        );
    }

    public function export()
    {
        $period = \App\Models\SalaryPeriod::orderByDesc('year')
            ->orderByDesc('month')
            ->first();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

        $spreadsheet->removeSheetByIndex(0);

        foreach (['PNS', 'PPPK'] as $type) {
            $sheet = $spreadsheet->createSheet();

            $sheet->setTitle($type);

            $this->fillTypeSheet(
                $sheet,
                $period,
                $type
            );
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx(
            $spreadsheet
        );

        $filename = 'Rekap-Perubahan-Gaji-' .
            str_replace(' ', '-', $period->label) .
            '.xlsx';

        return response()->streamDownload(
            function () use ($writer) {
                $writer->save('php://output');
            },
            $filename,
            [
                'Content-Type' =>
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ]
        );
    }
    
    private function fillTypeSheet(
        \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet,
        $period,
        string $type
    ): void {
        $bulan = [
            '',
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];

        $sheet->mergeCells('A1:S1');
        $sheet->setCellValue(
            'A1',
            'REKAP PERUBAHAN GAJI ' .
            $type .
            ' CABANG DINAS PENDIDIKAN WILAYAH KABUPATEN MALANG'
        );

        $sheet->mergeCells('A2:S2');
        $sheet->setCellValue(
            'A2',
            'BULAN ' .
            strtoupper($bulan[$period->month]) .
            ' TAHUN ' .
            $period->year
        );

        foreach (['A1', 'A2'] as $cell) {
            $sheet->getStyle($cell)
                ->getFont()
                ->setBold(true)
                ->setSize(13);

            $sheet->getStyle($cell)
                ->getAlignment()
                ->setHorizontal('center');
        }

        // Header baris 4-5
        $sheet->mergeCells('A4:A5')
            ->setCellValue('A4', 'NO.');

        $sheet->mergeCells('B4:B5')
            ->setCellValue('B4', 'NAMA');

        $sheet->mergeCells('C4:C5')
            ->setCellValue('C4', 'NIP');

        $sheet->mergeCells('D4:J4')
            ->setCellValue('D4', 'BARU');

        $sheet->mergeCells('K4:Q4')
            ->setCellValue('K4', 'LAMA');

        $sheet->mergeCells('R4:R5')
            ->setCellValue('R4', 'KETERANGAN');

        $sheet->mergeCells('S4:S5')
            ->setCellValue('S4', 'UNIT KERJA');

        $subHeaders = [
            'GOL',
            'ISTRI/SUAMI',
            'ANAK',
            'GAJI POKOK',
            'TUNJ. STRUKTURAL',
            'TUNJ. FUNGSIONAL',
            'MASA KERJA',
        ];

        $colsBaru = [
            'D',
            'E',
            'F',
            'G',
            'H',
            'I',
            'J',
        ];

        $colsLama = [
            'K',
            'L',
            'M',
            'N',
            'O',
            'P',
            'Q',
        ];

        foreach ($subHeaders as $i => $label) {
            $sheet->setCellValue(
                $colsBaru[$i] . '5',
                $label
            );

            $sheet->setCellValue(
                $colsLama[$i] . '5',
                $label
            );
        }

        $headerRange = 'A4:S5';

        $sheet->getStyle($headerRange)
            ->getFont()
            ->setBold(true);

        $sheet->getStyle($headerRange)
            ->getAlignment()
            ->setHorizontal('center')
            ->setVertical('center')
            ->setWrapText(true);

        $sheet->getStyle($headerRange)
            ->getFill()
            ->setFillType(
                \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID
            )
            ->getStartColor()
            ->setRGB('C9D9F1');

        $sheet->getStyle($headerRange)
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(
                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            );

        // Data
        $items = \App\Models\SalaryChangeItem::whereHas(
            'submission',
            function ($q) use ($period, $type) {
                $q->where('period_id', $period->id)
                    ->where('type', $type);
            }
        )
            ->with('submission.school')
            ->get()
            ->sortBy('submission.school.id')
            ->values();

        $row = 6;

        foreach ($items as $i => $item) {
            $sheet->setCellValue(
                "A$row",
                $i + 1
            );

            $sheet->setCellValue(
                "B$row",
                $item->nama
            );

            $sheet->setCellValue(
                "C$row",
                $item->nip
            );

            $sheet->setCellValue(
                "D$row",
                $item->gol_baru
            );

            $sheet->setCellValue(
                "E$row",
                $item->istri_suami_baru
            );

            $sheet->setCellValue(
                "F$row",
                $item->anak_baru
            );

            $sheet->setCellValue(
                "G$row",
                $item->gaji_pokok_baru
            );

            $sheet->setCellValue(
                "H$row",
                $item->tunj_struktural_baru
            );

            $sheet->setCellValue(
                "I$row",
                $item->tunj_fungsional_baru
            );

            $sheet->setCellValue(
                "J$row",
                $item->masa_kerja_baru
            );

            $sheet->setCellValue(
                "K$row",
                $item->gol_lama
            );

            $sheet->setCellValue(
                "L$row",
                $item->istri_suami_lama
            );

            $sheet->setCellValue(
                "M$row",
                $item->anak_lama
            );

            $sheet->setCellValue(
                "N$row",
                $item->gaji_pokok_lama
            );

            $sheet->setCellValue(
                "O$row",
                $item->tunj_struktural_lama
            );

            $sheet->setCellValue(
                "P$row",
                $item->tunj_fungsional_lama
            );

            $sheet->setCellValue(
                "Q$row",
                $item->masa_kerja_lama
            );

            $sheet->setCellValue(
                "R$row",
                $item->kategori
            );

            $sheet->setCellValue(
                "S$row",
                $item->submission->school->official_name
            );

            $row++;
        }

        if ($row > 6) {
            $dataRange = 'A6:S' . ($row - 1);

            $sheet->getStyle($dataRange)
                ->getBorders()
                ->getAllBorders()
                ->setBorderStyle(
                    \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                );
        }

        foreach (range('A', 'S') as $col) {
            $sheet->getColumnDimension($col)
                ->setAutoSize(true);
        }
    }
}