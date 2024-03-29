<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Style\{NumberFormat, Border, Fill};

use Maatwebsite\Excel\Concerns\{FromArray, FromQuery, WithTitle, Exportable, WithEvents, WithHeadings, ShouldAutoSize, WithColumnFormatting};

class TransactionsReportMonth implements WithHeadings, ShouldAutoSize, FromArray, WithTitle, WithColumnFormatting, WithEvents
{
    use Exportable;

    public function headings(): array{
        return [
            [' '],['','Empresa: ', $this->companyName],[' '],
            ['#',
            'Clientes',
            'No de Apartamento',
            'Fecha de Operación',
            'Monto de la_operacion',
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
            'Cantidad de Apartamentos Acumulados',
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

    public function forYear(int $year)
    {
        $this->year = $year;
        return $this;
    }

    public function forMonth(int $month)
    {
        $this->month = $month;
        return $this;
    }

    public function forCompanyID(int $companyID)
    {
        $this->companyID = $companyID;
        return $this;
    }

    public function array(): array
    {
        return DB::select('CALL reportTransactions (?, ?, ?)', array($this->month,$this->year,$this->companyID)); // Procedimiento Almacenado para generar reporte por mes
    }

    public function title(): string
    {
        return 'Reporte Mensual';
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
