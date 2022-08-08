<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CronErrorLog extends Model
{
    use HasFactory;

    protected $fillable = ['module_type','error'];
}
