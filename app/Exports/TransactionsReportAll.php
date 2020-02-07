<?php

namespace App\Exports;

use App\Client;
use App\Company;
use App\Funding;
use App\Activity;
use App\Transaction;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class TransactionsReportAll implements WithHeadings, ShouldAutoSize, FromArray, WithTitle, WithColumnFormatting, WithEvents
{
    use Exportable;

    public function headings(): array{
        return [
            [' '],['','Empresa: ', $this->companyName],[' '],
            ['#',
            'Cliente',
            'No de Apartamento',
            'Fecha de Operación',
            'Monto de la operacion',
            'Fecha de Traspaso de Escritura',
            'Banco Intermediario',
            'Fondos',
            'Forma de Pago',
            'Lugar de Trabajo',
            'Puesto',
            'Salario',
            'Fuente de Ingreso',
            'Edad',
            'Identidad',
            'No. de Apartamentos',
            'No. de Apartamentos Acumulados',
            'Riesgo'],
        ]; //Asigna el encabezado predeterminado de los datos a exportar
    }//Fin de la funcion

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'F' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'E' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED2,
            'L' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED2,
        ];
    }

    public function forCompanyName(string $companyName)
    {
        $this->companyName = $companyName;
        return $this;
    }

    public function forCompanyID(int $companyID)
    {
        $this->companyID = $companyID;
        return $this;
    }

    public function array(): array
    {
        return DB::select('CALL reportTransactionsAll (?)', array($this->companyID)); // Procedimiento Almacenado para generar reporte un total
    }

    public function title(): string
    {
        return 'Reporte Completo';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $styleArrayheadings = [
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                        'name' => 'Arial',
                        'color' => ['argb' => 'FFFFFFFF'],
                    ],
                    'borders' => [
                        'outline' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => '00000000',
                        ],
                    ],
                ];
                $styleArrayTitle = [
                    'font' => [
                        'bold' => true,
                        'size' => 13,
                        'name' => 'Arial',
                        'color' => ['argb' => '00000000'],
                    ],
                    'borders' => [
                        'outline' => [
                            'borderStyle' => Border::BORDER_THICK,
                        ],
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => 'FFFFFFFF',
                        ],
                    ],
                ];

                $event->sheet->getDelegate()->getStyle('B2:C2')->applyFromArray($styleArrayTitle);
                $event->sheet->getDelegate()->getStyle('A4:R4')->applyFromArray($styleArrayheadings);
            },
        ];
    }
}
