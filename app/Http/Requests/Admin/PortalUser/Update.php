<?php

namespace App\Http\Requests\Admin\PortalUser;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:portal_users,id',
            'name' => 'required|min:3',
            'email' => 'required|email|unique:portal_users,email,'.$this->id,
            'role_slug' => 'required|exists:portal_user_roles,role_slug'
        ];
    }
}
