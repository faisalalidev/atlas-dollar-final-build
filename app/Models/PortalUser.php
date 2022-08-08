<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class PortalUser extends Authenticatable
{
    use HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_slug',
        'email_verified_at',
        'web_login',
        'portal_login',
        'remember_token',
        'phone',
        'approved_by_admin',
        'user_type',
        'store_id',
        'deleted_at'
    ];

    protected $appends = ['approved','created'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getCreatedAttribute($value)
    {
        return date('m/d/y H:i:s',strtotime($this->created_at));
    }

    public function role_detail()
    {
        return $this->belongsTo(PortalUserRole::class, 'role_slug', 'role_slug');
    }

    public function getCreatedAtAttribute($value)
    {
        return date('m/d/y H:i:s',strtotime($value));
    }

    public function store()
    {
        return $this->belongsTo(Store::class,'store_id','customer_id');
    }

    public function getUserTypeAttribute($value)
    {
        return strtoupper($value);
    }

    public function updateProfile($params, $user_id)
    {
        if (isset($params['password'])) {
            $params['password'] = Hash::make($params['password']);
        }

        $this->where('id', $user_id)->update(collect($params)->only($this->getFillable())->whereNotNull()->toArray());
    }

    public function billingAddress()
    {
        return $this->hasOne(PortalUserAddress::class,'user_id')->where('type','billing_address');
    }

    public function shippingAddress()
    {
        return $this->hasOne(PortalUserAddress::class,'user_id')->where('type','shipping_address');
    }

    public function recentlyViewedProducts()
    {
        return $this->hasMany(RecentlyViewedProduct::class,'user_id');
    }

    public function getApprovedAttribute()
    {
        return $this->approved_by_admin ? 'Approved' : 'Not Approved';
    }

    public function getDataTableColumns()
    {
        return [
            [
                'title' => 'Name',
                'data' => 'name'
            ],
            [
                'title' => 'Email',
                'data' => 'email'
            ],
            [
                'title' => 'Role',
                'data' => 'role_detail.role_name'
            ],
            [
                'title' => 'Created At',
                'data' => 'created_at',
            ],
            [
                'title' => 'Actions',
                'data' => 'actions'
            ]
        ];
    }

    public function getManagersDataTableColumns()
    {
        return [
            [
                'title' => 'Name',
                'data' => 'name'
            ],
            [
                'title' => 'Email',
                'data' => 'email'
            ],
            [
                'title' => 'Store',
                'data' => 'store.name'
            ],
            [
                'title' => 'Store Id',
                'data' => 'store_id'
            ],
            [
                'title' => 'User Type',
                'data' => 'user_type'
            ],
            [
                'title' => 'Status',
                'data' => 'approved',
                'searchable' => false
            ],
            [
                'title' => 'Approve',
                'data' => 'approve',
                'searchable' => 'false'
            ],
            [
                'title' => 'Created At',
                'data' => 'created',
                'searchable' => 'false'
            ],
            [
                'title' => 'Created At',
                'data' => 'created_at',
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
        return $this->query()->where('portal_login',1)->with('role_detail')->whereNotIn('id', [auth()->id(), config('constants.IGNORE_AS_PORTAL_USER_ID')]);
    }

    public function managersAjaxListing()
    {
        return $this->query()->whereNull('deleted_at')->where('web_login',1)->with('store')->whereNotIn('id', [auth()->id(), config('constants.IGNORE_AS_PORTAL_USER_ID')]);
    }
}
