<?php

namespace App\Http\Requests\Server\Setup;

use App\Options;
use App\Server\Setup;
use Illuminate\Foundation\Http\FormRequest;

class Key extends FormRequest
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

    public function messages()
    {
        return [
            'key.in' => __('app.setup.provided-key-invalid'),
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Options $options)
    {
        $key = $options->get(Setup::KEY_OPTION);

        return [
            'key' => 'required|in:' . $key,
        ];
    }
}
