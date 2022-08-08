<?php

namespace App\Http\Requests\Admin\Inventory;

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
            'sub_category' => 'required|exists:categories,category_number',
            'description' => 'required',
            'supplier_part_number' => 'required',
            'part_number' => 'required',
            'price' => 'required|numeric',
            'in_stock' => 'required|numeric',
            'status' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'Title field is required.',
            'supplier_part_number.required' => 'Supplier field is required.',
            'part_number.required' => 'SKU field is required.',
        ];
    }
}
