<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryBarcode extends Model
{
    use HasFactory;

    protected $fillable = ['alt_supply_id', 'inventory_id', 'supplier_id', 'barcode'];

    public function createInventoryBarcodes($data, $inventory_id)
    {
        $this->where('inventory_id', $inventory_id)->delete();

        foreach ($data as $barcode) {

            $this->create([
                'inventory_id' => $inventory_id,
                'alt_supply_id' => $barcode->AltSupplyId,
                'supplier_id' => $barcode->SupplierId,
                'barcode' => $barcode->Barcode
            ]);
        }
    }
}
