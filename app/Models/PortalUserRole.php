<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortalUserRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_name',
        'role_slug'
    ];

    public function getDataTableColumns()
    {
        return [
            [
                'title' => 'Role Name',
                'data' => 'role_name'
            ],
            [
                'title' => 'Created At',
                'data' => 'created_at'
            ],
            [
                'title' => 'Actions',
                'data' => 'actions'
            ]
        ];
    }

    public function ajaxListing()
    {
        return $this->query()->where('role_slug', '!=', config('constants.ALL_PRIVILEGE_ROLE_SLUG'));
    }
}
