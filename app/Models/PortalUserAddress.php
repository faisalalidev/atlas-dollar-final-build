<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortalUserAddress extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'name', 'company', 'address', 'city', 'country', 'postal_code', 'phone', 'user_id'];
}
