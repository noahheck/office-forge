<?php


namespace App\Form;

use Illuminate\Validation\Rule;

use App\Enum\USStates;
use App\FileType\Form;

class FieldValidationRulesGenerator
{
    public function generateRulesForForm($form)
    {
        $stateAbbreviations = implode(',', array_keys(USStates::statesIndexedByAbbreviation()));

        $rules = [];

        foreach ($form->fields as $field) {

            $fieldType = $field->field_type;
            $fieldName = $field->fieldName();

            $rules[$fieldName] = 'nullable';

            if ($fieldType === 'email') {
                $rules[$fieldName] = 'nullable|email';
            }

            if ($fieldType === 'date') {
                $rules[$fieldName] = 'nullable|date';
            }

            if ($fieldType === 'address') {
                $rules[$fieldName . '_1'] = 'nullable';
                $rules[$fieldName . '_2'] = 'nullable';
                $rules[$fieldName . '_3'] = 'nullable';
                $rules[$fieldName . '_4'] = 'nullable|in:' . $stateAbbreviations;
                $rules[$fieldName . '_5'] = 'nullable';
            }

            if ($fieldType === 'name') {
                $rules[$fieldName . '_1'] = 'nullable';
                $rules[$fieldName . '_2'] = 'nullable';
                $rules[$fieldName . '_3'] = 'nullable';
                $rules[$fieldName . '_4'] = 'nullable';
            }

            if (in_array($fieldType, ['monetary', 'decimal'])) {
                $rules[$fieldName] = 'nullable|numeric';
            }

            if ($fieldType === 'integer') {
                $rules[$fieldName] = 'nullable|integer';
            }

            if ($fieldType === 'select') {
                $rules[$fieldName] = ['nullable', Rule::in($field->selectOptions())];
            }

            if (in_array($fieldType, ['user', 'file'])) {
                $rules[$fieldName] = 'nullable|integer';
            }

        }

        return $rules;
    }



    public function generateNameAttributesForForm($form)
    {
        $attributeNames = [];

        foreach ($form->fields as $field) {

            $fieldName = $field->fieldName();
            $fieldType = $field->field_type;

            $attributeNames[$fieldName] = $field->label;

            if ($fieldType === 'address') {
                $attributeNames[$fieldName . '_1'] = __('file.field_fieldTypeAddressPreviewLine1Placeholder');
                $attributeNames[$fieldName . '_2'] = __('file.field_fieldTypeAddressPreviewLine2Placeholder');
                $attributeNames[$fieldName . '_3'] = __('file.field_fieldTypeAddressPreviewCityPlaceholder');
                $attributeNames[$fieldName . '_4'] = __('file.field_fieldTypeAddressPreviewStatePlaceholder');
                $attributeNames[$fieldName . '_5'] = __('file.field_fieldTypeAddressPreviewZipPlaceholder');
            }

            if ($fieldType === 'name') {
                $attributeNames[$fieldName . '_1'] = __('file.field_fieldTypeNamePreviewFirstNamePlaceholder');
                $attributeNames[$fieldName . '_2'] = __('file.field_fieldTypeNamePreviewMiddleNamePlaceholder');
                $attributeNames[$fieldName . '_3'] = __('file.field_fieldTypeNamePreviewLastNamePlaceholder');
                $attributeNames[$fieldName . '_4'] = __('file.field_fieldTypeNamePreviewSuffixPlaceholder');
            }

        }

        return $attributeNames;
    }
}
