<?php

namespace App\Exports;

use App\Models\InvoiceProduct;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class InvoiceProductsExport implements FromCollection,WithHeadings,WithMapping
{
    private $invoice;
    private $line = 0;

    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       return $this->invoice->products()->get();
    }

    public function map($row): array
    {
        $this->line = $this->line + 1;

        return [
            $this->line,
            $row->invoice_number,
            $row->inventory->part_number,
            $row->description,
            $row->inventory->in_stock,
            $row->inventory->price,
            '$'.$row->price,
            $row->ordered,
            $row->ordered,
            0,
            addCurrencyToPrice((double)$row->price * (int)$row->ordered),
            addCurrencyToPrice((double)$row->price * (int)$row->ordered),
        ];
    }

    public function headings(): array
    {
        return ["Line","Invoice Number","Item", "Description",'Cs. Pack',"Piece Price","List Price", "Ordered","Shipped",'Pieces', "Total List",'Total'];
    }
}
