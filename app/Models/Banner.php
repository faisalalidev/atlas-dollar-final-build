<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'image', 'text'];

    protected $appends = ['display_image','display_type'];

    public function getDisplayImageAttribute()
    {
        return $this->image;
    }

    public function getDisplayTypeAttribute()
    {
        return str_replace('_',' ',$this->type);
    }

    public function getDataTableColumns()
    {
        return [
            [
                'title' => 'Image',
                'data' => 'display_image'
            ],
            [
                'title' => 'Type',
                'data' => 'display_type',
                'searchable' => 'false'
            ],
            [
                'title' => 'Type',
                'data' => 'type',
                'visible' => false
            ],
            [
                'title' => 'Actions',
                'data' => 'actions'
            ]
        ];
    }

    public function ajaxListing()
    {
        return $this->query();
    }
}
