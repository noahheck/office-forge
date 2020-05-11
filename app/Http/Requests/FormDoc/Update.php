<?php

namespace App\Http\Requests\FormDoc;

use App\Form\FieldValidationRulesGenerator;
use App\FormDoc\Template;
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
        // @todo Make sure authorization is in place correctly
        return true;
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
        $formDoc = $this->form_doc;

        $rules = $generator->generateRulesForForm($formDoc);

        $this->nameAttributes = $generator->generateNameAttributesForForm($formDoc);

        return $rules;
    }
}
