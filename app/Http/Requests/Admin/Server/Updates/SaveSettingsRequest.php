<?php

namespace App\Http\Requests\Admin\Server\Updates;

use Illuminate\Foundation\Http\FormRequest;

class SaveSettingsRequest extends FormRequest
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
        $scheduleOptions = implode(',', array_keys(\App\Server\Updates::scheduleOptions()));
        $timeOptions = implode(',', \App\Server\Updates::timeOptions());

        return [
            'schedule' => 'required|in:' . $scheduleOptions,
            'time' => 'required|in:' . $timeOptions,
        ];
    }
}
