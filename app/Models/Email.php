<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $fillable = ['title','recipients','slug','description'];

    public function getDataTableColumns()
    {
        return [
            [
                'title' => 'Name',
                'data' => 'title'
            ],

            [
                'title' => 'Recipients',
                'data' => 'recipients'
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
