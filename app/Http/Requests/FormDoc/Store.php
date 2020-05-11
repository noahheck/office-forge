<?php

namespace App\Http\Requests\FormDoc;

use App\Form\FieldValidationRulesGenerator;
use App\FormDoc\Template;
use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
        $template = Template::find($this->form_doc_template_id);

        $rules = $generator->generateRulesForForm($template);

        $this->nameAttributes = $generator->generateNameAttributesForForm($template);

        return $rules;
    }
}
