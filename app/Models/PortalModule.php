<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortalModule extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_name',
        'module_slug',
        'module_icon',
        'sort_number',
    ];
}
