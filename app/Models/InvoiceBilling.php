<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceBilling extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_number', 'name', 'address', 'city', 'state', 'country', 'postal_zip_code'];

    public function createInvoiceBillings($billings, $invoice_number)
    {
        $this->where('invoice_number',$invoice_number)->delete();

        foreach ($billings as $billing){

            $this->create([
               'invoice_number' => $invoice_number,
               'name' => $billing->Name,
               'address' => $billing->Address1,
               'city' => $billing->City,
               'state' => $billing->State,
               'country' => $billing->Country,
               'postal_zip_code' => $billing->PostalZipCode,
            ]);
        }
    }
}
