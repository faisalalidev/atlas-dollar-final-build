<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_number', 'inventory_id', 'price', 'ordered', 'description'];

    public function createInvoiceProducts($products,$invoice_number)
    {
        $this->where('invoice_number',$invoice_number)->delete();

        foreach ($products as $product){

            $this->create([
               'invoice_number' => $invoice_number,
               'inventory_id' => $product->PartUnique,
               'price' => $product->Price,
               'ordered' => $product->Ordered,
               'description' => $product->Description,
            ]);
        }
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class,'inventory_id','inventory_id');
    }
}
