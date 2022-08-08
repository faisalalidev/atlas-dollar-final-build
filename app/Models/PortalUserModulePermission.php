<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortalUserModulePermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_slug',
        'role_slug',
        'can_add',
        'can_edit',
        'can_view',
        'can_delete'
    ];

    public function storeDate($data)
    {

        $this->where('role_slug', $data['role_slug'])->delete();

        foreach ($data['permissions'] as $module_name => $permission) {
            $this->create([
                'module_slug' => $module_name,
                'role_slug' => $data['role_slug'],
                'can_add' => isset($permission['can_add']),
                'can_edit' => isset($permission['can_edit']),
                'can_view' => isset($permission['can_view']),
                'can_delete' => isset($permission['can_delete'])
            ]);
        }
    }
}
