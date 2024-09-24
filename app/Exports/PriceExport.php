<?php

namespace App\Exports;

use App\Models\Price;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PriceExport implements FromCollection, WithHeadings, WithMapping, WithCustomStartCell, WithEvents {

    protected $request;

    public function __construct($request) {
        $this->request = $request;
    }

    public function collection() {
        $query = Price::with('product')->orderBy('created_at', 'asc');

        if (!empty($this->request->client_id)) {
            $query->where('client_id', $this->request->client_id);
        }
        
        if (!empty($this->request->product_id)) {
            $query->where('product_id', $this->request->product_id);
        }

        if (!empty($this->request->dateStart)) {
            $query->whereDate('created_at', '>=', $this->request->dateStart);
        }

        if (!empty($this->request->dateEnd)) {
            $query->whereDate('created_at', '<=', $this->request->dateEnd);
        }

        return $query->get();
    }

    public function headings(): array {
        return [
            'Data',
            'Produto',
            'Quantidade',
            'Valor',
            'Valor Total'
        ];
    }

    public function map($price): array {
        return [
            $price->created_at->format('d/m/Y'),    
            $price->product->name, 
            $price->amount,                     
            number_format($price->product->value, 2),   
            number_format($price->value, 2),            
        ];
    }

    public function startCell(): string {
        return 'A1';
    }

    public function registerEvents(): array {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $sheet->getStyle('A1:E1')->getFont()->setBold(true);
                $sheet->getStyle('A1:E1')->getAlignment()->setHorizontal('center');

                $sheet->getColumnDimension('A')->setWidth(20);
                $sheet->getColumnDimension('B')->setWidth(30);
                $sheet->getColumnDimension('C')->setWidth(15);
                $sheet->getColumnDimension('D')->setWidth(15);
                $sheet->getColumnDimension('E')->setWidth(15);

                $rowCount = 2;
                foreach ($this->collection() as $price) {
                    $rowColor = ($rowCount % 2 === 0) ? 'transparent' : 'CCCCCC';

                    $sheet->getStyle('A' . $rowCount . ':E' . $rowCount)->applyFromArray([
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'startColor' => [
                                'argb' => $rowColor,
                            ],
                        ],
                    ]);

                    $rowCount++;
                }
            },
        ];
    }
}
