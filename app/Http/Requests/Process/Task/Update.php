<?php

namespace App\Http\Requests\Process\Task;

use App\Process\Instance;
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
        $user = $this->user();

        if ($user->isAdministrator()) {
            return true;
        }

        $instance = Instance::find($this->route('instance'));

        return $instance && $instance->owner->id === $user->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

        ];
    }
}
