<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CronSyncQueue extends Model
{
    use HasFactory;

    protected $fillable = ['module','synced'];
}
