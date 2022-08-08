<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = ['order_id','inventory_id','quantity','price'];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class,'inventory_id','inventory_id');
    }
}
