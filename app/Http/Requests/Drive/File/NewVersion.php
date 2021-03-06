<?php

namespace App\Http\Requests\Drive\File;

use Illuminate\Foundation\Http\FormRequest;

class NewVersion extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $drive = $this->route('drive');

        return $drive && $this->user()->can('editContents', $drive);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file' => 'required|file',
            'name' => 'required',
        ];
    }
}
