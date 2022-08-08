<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryPrice extends Model
{
    use HasFactory;

    protected $fillable = ['level', 'department', 'regular', 'sale', 'inventory_id'];

    public function createInventoryPrices($data, $inventory_id)
    {
        $this->where('inventory_id', $inventory_id)->delete();

        foreach ($data as $price) {

            $this->create([
                    'inventory_id' => $inventory_id,
                    'level' => $price->Level,
                    'department' => $price->Department,
                    'regular' => $price->Regular,
                    'sale' => $price->Sale
                ]
            );
        }
    }
}
