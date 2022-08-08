<?php

namespace App\Http\Requests\Admin\PortalUser;

use Illuminate\Foundation\Http\FormRequest;

class Add extends FormRequest
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
            'name' => 'required|min:3',
            'password' => 'required|min:3',
            'email' => 'required|email|unique:portal_users,email',
            'role_slug' => 'required|exists:portal_user_roles,role_slug'
        ];
    }
}
