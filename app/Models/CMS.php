<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CMS extends Model
{
    use HasFactory;

    protected $table = 'cms';

    protected $fillable = ['title','slug','html'];

    public function getDataTableColumns()
    {
        return [
            [
                'title' => 'Name',
                'data' => 'title'
            ],

            [
                'title' => 'Slug',
                'data' => 'slug'
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
