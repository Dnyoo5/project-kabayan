<?php

namespace App\Exports;

use App\Models\barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class BarangExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Hanya memilih kolom yang diinginkan
        return barang::select('nama_barang','kategori_id','jumlah','created_at');
    }

    private $rowNumber = 0;

    public function headings(): array
    {
        return [
            'No',
            'Nama Barang',
            'Kategori',
            'Jumlah',
            'Tanggal'
        ];
    }

    public function map($barang): array
    {
        $this->rowNumber++;
        return [
            $this->rowNumber,
            $barang->nama_barang,
            $barang->kategori,
            $barang->jumlah,
            Carbon::parse($barang->created_at)->format('d-M-Y'),
        ];
    }
    
    public function styles(Worksheet $sheet)
    {
        // Menambahkan gaya pada header
        $sheet->getStyle('A1:E1')->applyFromArray([
            'font' => [
                'bold' => true,
            ], 
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Menambahkan border pada semua sel
        $sheet->getStyle('A1:E' . $sheet->getHighestRow())->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        return [];
    }
}

