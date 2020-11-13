<?php

namespace App\Http\Requests\Admin\Reports\Datasets;

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
        return true;
    }

    public function messages()
    {
        return [
            'datasetable_type.required' => __('report.dataset_pleaseSelectDataTypeForDataset'),
            'App_FileType_datasetable_id.required_if' => __('report.dataset_pleaseSelectFileTypeForDataset'),
            'App_FormDoc_Template_datasetable_id.required_if' => __('report.dataset_pleaseSelectFormDocForDataset'),
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $datasetableTypes = [
            'App\\FileType',
            'App\\FormDoc\\Template',
        ];

        return [
            'name' => 'required',
            'datasetable_type' => 'required|in:' . implode(',', $datasetableTypes),
            'App_FileType_datasetable_id' => 'required_if:datasetable_type,App\\FileType',
            'App_FormDoc_Template_datasetable_id' => 'required_if:datasetable_type,App\\FormDoc\\Template',
        ];
    }
}
