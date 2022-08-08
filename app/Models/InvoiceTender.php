<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceTender extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_number', 'type', 'amount'];

    public function createInvoiceTender($tenders,$invoice_number)
    {
        $this->where('invoice_number',$invoice_number)->delete();

        foreach ($tenders as $tender){

            $this->create([
               'invoice_number' => $invoice_number,
               'type' => $tender->Type,
               'amount' => $tender->Amount,
            ]);
        }
    }
}
