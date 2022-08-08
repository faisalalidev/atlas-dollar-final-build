<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreContact extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'contact_id', 'first_name', 'last_name', 'address1', 'address2', 'city', 'country', 'state', 'postal',
        'phone1', 'phone2', 'email'];

    public function createStoreContacts($contacts,$customer_id)
    {
        $this->where('customer_id',$customer_id)->delete();

        foreach ($contacts as $contact){

            $this->create([
                'customer_id' => $customer_id,
                'contact_id' => $contact->ContactId,
                'first_name' => $contact->FirstName,
                'last_name' => $contact->LastName,
                'address1' => $contact->Address1,
                'address2' => $contact->Address2,
                'city' => $contact->City,
                'country' => $contact->Country,
                'state' => $contact->State,
                'postal' => $contact->Postal,
                'phone1' => $contact->Phone1,
                'phone2' => $contact->Phone2,
                'email' => $contact->Email,
            ]);
        }
    }

    public function store()
    {
        return $this->belongsTo(Store::class,'customer_id','customer_id');
    }
}
