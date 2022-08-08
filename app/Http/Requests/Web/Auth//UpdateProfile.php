<?php

namespace App\Http\Requests\Web\Auth\;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfile extends FormRequest
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
            'email' => 'required|email|unique:portal_users,email,' . auth()->guard(config('constants.WEB_GUARD_NAME'))->id(),
            'name' => 'required',
            'password' => 'nullable|min:8|confirmed',
        ];
    }
}
