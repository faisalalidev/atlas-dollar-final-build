<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomCronJob extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'time_to_execute', 'command'];

    public function getDataTableColumns()
    {
        return [
            [
                'title' => 'Name',
                'data' => 'name'
            ],

            [
                'title' => 'Cron Time',
                'data' => 'time_to_execute'
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
