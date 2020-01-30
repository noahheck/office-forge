<?php

namespace App\Http\Requests\Process;

use App\Process;
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
        $process = Process::find($this->input('process_id'));

        return $process && $process->active && $process->canBeInstantiatedBy($this->user());
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
            'process_id' => 'required|int',
            'owner_id' => 'required|int',
        ];
    }
}
