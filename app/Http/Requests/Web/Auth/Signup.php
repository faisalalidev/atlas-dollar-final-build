<?php

namespace App\Http\Requests\Web\Auth;

use Illuminate\Foundation\Http\FormRequest;

class Signup extends FormRequest
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
            'register_email' => 'required|unique:portal_users,email',
            'register_name' => 'required',
            'register_store_id' => 'required|numeric|exists:stores,customer_id',
            'register_user_type' => 'required',
            'register_phone' => 'required|numeric',
            'register_password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:8'
        ];
    }
}
