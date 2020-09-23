<?php

namespace App\Http\Requests\Admin\Backups;

use App\Backups;
use Illuminate\Foundation\Http\FormRequest;

class SaveSettings extends FormRequest
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
        $timeOptions = implode(',', Backups::timeOptions());
        $storageTimeOptions = implode(',', array_keys(Backups::storageTimeOptions()));

        return [
            'time' => 'required|in:' . $timeOptions,
            'storageTime' => 'required|in:' . $storageTimeOptions,
        ];
    }
}
