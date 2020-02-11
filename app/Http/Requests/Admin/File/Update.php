<?php

namespace App\Http\Requests\Admin\File;

use App\File;
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
        $iconOptions = implode(',', array_values(File::ICON_OPTIONS));

        return [
            'name' => 'required',
            'icon' => 'required|in:' . $iconOptions,
        ];
    }
}
