<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['cart_id', 'inventory_id', 'quantity'];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class,'inventory_id','inventory_id');
    }
}
