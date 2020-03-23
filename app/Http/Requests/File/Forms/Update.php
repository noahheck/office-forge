<?php

namespace App\Http\Requests\File\Forms;

use App\FileType\Form;
use App\FileType\Form\FieldValidationRulesGenerator;
use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    private $nameAttributes;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->form->isAccessibleBy($this->user());
    }

    public function attributes()
    {
        return $this->nameAttributes;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(FieldValidationRulesGenerator $generator)
    {
        $rules = $generator->generateRulesForForm($this->form);

        $this->nameAttributes = $generator->generateNameAttributesForForm($this->form);

        return $rules;
    }
}
