<?php

namespace App\Http\Requests\Drive\Folders;

use App\FileStore\Drive;
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
        $drive = $this->route('drive');

        return $drive && $this->user()->can('view', $drive);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }
}
