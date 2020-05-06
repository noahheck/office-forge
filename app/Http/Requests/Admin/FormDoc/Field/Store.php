<?php

namespace App\Http\Requests\Admin\FormDoc\Field;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
        $fileTypes = array_keys(\App\filetype_field_options());

        $fileTypes = implode(',', $fileTypes);

        return [
            'label' => 'required',
            'field_type' => 'in:' . $fileTypes,
        ];
    }
}
