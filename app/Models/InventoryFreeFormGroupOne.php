<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryFreeFormGroupOne extends Model
{
    use HasFactory;

    protected $table = 'inventory_free_form_group_one';

    protected $fillable = ['inventory_id','free_form_id','free_form_data'];

    public function createFormGroups($data, $inventory_id)
    {
        $this->where('inventory_id', $inventory_id)->delete();

        foreach ($data as $group) {

            $this->create([
                    'inventory_id' => $inventory_id,
                    'free_form_id' => $group->FreeFormID,
                    'free_form_data' => $group->FreeFormData,
                ]
            );
        }
    }
}
