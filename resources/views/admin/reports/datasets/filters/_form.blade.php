@push('scripts')
    @script('js/page.admin.reports.datasets.filters._form.js')
@endpush

@push('meta')
    @meta('report_filter-user', $report->filter_user)
    @meta('report_filter-date', $report->filter_date)
    @meta('filter_value-1', $filter->value_1)
    @meta('filter_value-2', $filter->value_2)
@endpush

@php

$userValue1Options = $report->filter_user ?
    [
        \App\Report\Dataset\Filter::FILTER_VALUE_USER_REPORT_FILTERED_USER => __('admin.filter_descriptor_userReportFilteredUser'),
        \App\Report\Dataset\Filter::FILTER_VALUE_USER_GENERATING_REPORT => __('admin.filter_descriptor_userUserGeneratingReport'),
        \App\Report\Dataset\Filter::FILTER_VALUE_USER_SPECIFIC_USER => __('admin.filter_descriptor_userReportSpecificUser'),
    ] :
    [
        \App\Report\Dataset\Filter::FILTER_VALUE_USER_GENERATING_REPORT => __('admin.filter_descriptor_userUserGeneratingReport'),
        \App\Report\Dataset\Filter::FILTER_VALUE_USER_SPECIFIC_USER => __('admin.filter_descriptor_userReportSpecificUser'),
    ];

$dateValue1Options = [];

if ($report->filter_date === \App\Report::REPORT_FILTER_DATE_NONE) {
    $dateValue1Options = [
        \App\Report\Dataset\Filter::FILTER_VALUE_DATE_SPECIFIC_DATE => __('admin.filter_descriptor_dateSpecifiedDates'),
    ];
}

if ($report->filter_date === \App\Report::REPORT_FILTER_DATE_DATE) {
    $dateValue1Options = [
        \App\Report\Dataset\Filter::FILTER_VALUE_DATE_REPORT_FILTERED_DATE => __('admin.filter_descriptor_dateReportFilteredDate'),
        \App\Report\Dataset\Filter::FILTER_VALUE_DATE_SPECIFIC_DATE => __('admin.filter_descriptor_dateSpecifiedDates'),
    ];
}

if ($report->filter_date === \App\Report::REPORT_FILTER_DATE_RANGE) {
    $dateValue1Options = [
        \App\Report\Dataset\Filter::FILTER_VALUE_DATE_REPORT_FILTERED_DATE_RANGE => __('admin.filter_descriptor_dateReportFilteredDateRange'),
        \App\Report\Dataset\Filter::FILTER_VALUE_DATE_SPECIFIC_DATE => __('admin.filter_descriptor_dateSpecifiedDates'),
    ];
}


@endphp

<form action="{{ $action }}" method="POST" class="bold-labels">
    @csrf

    @if($method ?? false)
        @method($method)
    @endif

    @hiddenField([
        'name' => 'return',
        'value' => old('return', url()->previous()),
    ])

    <div class="row">

        <div class="col-12">

            <p>
                {!! __('admin.filter_filterFormInformation', ['dataset' => e($dataset->name), 'dataTypeIcon' => $dataset->datasetable->icon(), 'dataType' => e($dataset->datasetable->name)]) !!}
            </p>

            <hr>

            <div class="form-group required">
                <label for="field_id">{{ __('admin.filter_fieldToFilter') }}</label>
                <select class="custom-select" id="field_id" name="field_id" autofocus>
                    <option value="">--</option>
                    @foreach ($dataset->datasetable->filterableFieldOptions() as $optgroup => $fields)
                        @if ($optgroup)
                            <optgroup label="{{ $optgroup }}">
                        @endif

                        @foreach ($fields as $field)
                            <option value="{{ $field['value'] }}" data-type="{{ $field['type'] }}" data-options='@json($field['options'])' {{ ($field['value'] == $filter->field_id) ? 'selected' : '' }}>{{ $field['label'] }}</option>
                        @endforeach

                        @if ($optgroup)
                            </optgroup>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="field-type-options-container" id="filterValueOptionsContainer">

                <div class="field-type-options d-none" id="checkboxOptions">

                    @selectField([
                        'name' => 'checkbox_operator',
                        'id' => 'checkbox_operator',
                        'label' => __('admin.filter_operator'),
                        'details' => '',
                        'value' => old('checkbox_operator', $filter->operator),
                        'options' => \App\Report\Dataset\Filter::checkboxOperatorOptions(),
                        'placeholder' => '',
                        'required' => false,
                        'autofocus' => false,
                        'error' => $errors->has('checkbox_operator'),
                        'readonly' => false,
                        'fieldOnly' => false,
                    ])

                </div>



                <div class="field-type-options d-none" id="selectOptions">

                    @selectField([
                        'name' => 'select_operator',
                        'id' => 'select_operator',
                        'label' => __('admin.filter_operator'),
                        'details' => '',
                        'value' => old('select_operator', $filter->operator),
                        'options' => \App\Report\Dataset\Filter::selectOperatorOptions(),
                        'placeholder' => '',
                        'required' => false,
                        'autofocus' => false,
                        'error' => $errors->has('select_operator'),
                        'readonly' => false,
                        'fieldOnly' => false,
                    ])

                    <div id="selectValueContainer" class="d-none">

                        @selectField([
                            'name' => 'select_value',
                            'id' => 'select_value',
                            'label' => '',
                            'details' => '',
                            'value' => old('select_value', $filter->value_1),
                            'options' => [],
                            'placeholder' => '',
                            'required' => false,
                            'autofocus' => false,
                            'error' => $errors->has('select_value'),
                            'readonly' => false,
                            'fieldOnly' => true,
                        ])

                    </div>
                </div>



                <div class="field-type-options d-none" id="userOptions">

                    @selectField([
                        'name' => 'user_operator',
                        'id' => 'user_operator',
                        'label' => __('admin.filter_operator'),
                        'details' => '',
                        'value' => old('user_operator', $filter->operator),
                        'options' => \App\Report\Dataset\Filter::userOperatorOptions(),
                        'placeholder' => '',
                        'required' => false,
                        'autofocus' => false,
                        'error' => $errors->has('user_operator'),
                        'readonly' => false,
                        'fieldOnly' => false,
                    ])

                    <div id="userValuesContainer">

                        @selectField([
                            'name' => 'user_value_1',
                            'label' => '',
                            'details' => '',
                            'value' => old('user_value_1', $filter->value_1),
                            'options' => $userValue1Options,
                            'placeholder' => '',
                            'required' => false,
                            'autofocus' => false,
                            'error' => $errors->has('select_value'),
                            'readonly' => false,
                            'fieldOnly' => true,
                        ])


                        <div id="userValue2Container">

                            @userSelectField([
                                'name' => 'user_value_2',
                                'label' => '',
                                'value' => old('user_value_2', $filter->value_2),
                                'users' => $userOptions,
                                'placeholder' => '',
                                'description' => '',
                                'required' => false,
                                'autofocus' => false,
                                'error' => $errors->has('user_value_2'),
                                'readonly' => false,
                                'fieldOnly' => false,
                            ])

                        </div>

                    </div>

                </div>



                <div class="field-type-options d-none" id="dateOptions">

                    @selectField([
                        'name' => 'date_operator',
                        'id' => 'date_operator',
                        'label' => __('admin.filter_operator'),
                        'details' => '',
                        'value' => old('date_operator', $filter->operator),
                        'options' => \App\Report\Dataset\Filter::dateOperatorOptions(),
                        'placeholder' => '',
                        'required' => false,
                        'autofocus' => false,
                        'error' => $errors->has('date_operator'),
                        'readonly' => false,
                        'fieldOnly' => false,
                    ])

                    <div id="dateValuesContainer">

                        @selectField([
                            'name' => 'date_value_1',
                            'id' => 'date_value_1',
                            'label' => '',
                            'details' => '',
                            'value' => old('date_value_1', $filter->value_1),
                            'options' => $dateValue1Options,
                            'placeholder' => '',
                            'required' => false,
                            'autofocus' => false,
                            'error' => $errors->has('filter_value_1'),
                            'readonly' => false,
                            'fieldOnly' => true,
                        ])

                        <div id="datepickerValuesContainer" class="pt-2 d-flex justify-content-between">

                            <div id="datepickerValue1Container" class="flex-grow-1">

                                @dateField([
                                    'name' => 'date_value_2',
                                    'label' => '',
                                    'details' => '',
                                    'value' => old('date_value_2', $filter->value_2),
                                    'placeholder' => '',
                                    'required' => false,
                                    'autofocus' => false,
                                    'error' => $errors->has('date_value_1'),
                                    'readonly' => false,
                                    'fieldOnly' => true,
                                ])

                            </div>

                            <div id="datepickerValue2Container" class="flex-grow-1 d-flex">

                                <strong class="flex-grow-0 px-3 pt-2"> {{ __('app.and') }} </strong>

                                <div class="flex-grow-1">

                                    @dateField([
                                        'name' => 'date_value_3',
                                        'label' => '',
                                        'details' => '',
                                        'value' => old('date_value_3', $filter->value_3),
                                        'placeholder' => '',
                                        'required' => false,
                                        'autofocus' => false,
                                        'error' => $errors->has('date_value_3'),
                                        'readonly' => false,
                                        'fieldOnly' => true,
                                    ])

                                </div>

                            </div>

                        </div>

                    </div>{{-- End of dateValuesContainer --}}

                </div>



                <div class="field-type-options d-none" id="numericOptions">

                    @selectField([
                        'name' => 'numeric_operator',
                        'id' => 'numeric_operator',
                        'label' => __('admin.filter_operator'),
                        'details' => '',
                        'value' => old('numeric_operator', $filter->operator),
                        'options' => \App\Report\Dataset\Filter::numericOperatorOptions(),
                        'placeholder' => '',
                        'required' => false,
                        'autofocus' => false,
                        'error' => $errors->has('numeric_operator'),
                        'readonly' => false,
                        'fieldOnly' => false,
                    ])

                    <div id="numericValuesContainer" class="d-flex justify-content-between">

                        <div id="numericValue1Container" class="flex-grow-1">

                            @integerField([
                                'name' => 'numeric_value_1',
                                'label' => '',
                                'details' => '',
                                'value' => old('numeric_value_1', $filter->value_1),
                                'placeholder' => '',
                                'required' => false,
                                'autofocus' => false,
                                'error' => $errors->has('numeric_value_1'),
                                'readonly' => false,
                                'fieldOnly' => true,
                            ])

                        </div>

                        <div id="numericValue2Container" class="flex-grow-1 d-flex">

                            <strong class="flex-grow-0 px-3 pt-2"> {{ __('app.and') }} </strong>

                            <div class="flex-grow-1">

                                @integerField([
                                'name' => 'numeric_value_2',
                                'label' => '',
                                'details' => '',
                                'value' => old('numeric_value_2', $filter->value_2),
                                'placeholder' => '',
                                'required' => false,
                                'autofocus' => false,
                                'error' => $errors->has('numeric_value_2'),
                                'readonly' => false,
                                'fieldOnly' => true,
                            ])

                            </div>

                        </div>

                    </div>

                </div>



            </div>

        </div>

    </div>

    <hr>

    <div class="d-flex">

        <div class="flex-grow-1">

            <button type="submit" class="btn btn-primary">
                {{ __('app.save') }}
            </button>

            <a class="btn btn-secondary" href="{{ url()->previous(route('admin.reports.show', [$report])) }}">
                {{ __('app.cancel') }}
            </a>

        </div>

        @if ($filter->id)
            <div class="flex-grow-0">
                <button type="button" class="btn btn-outline-primary" data-toggle="collapse" data-target="#moreOptionsContainer">
                    {{ __('app.moreOptions') }}
                    {!! \App\icon\chevronDown() !!}
                </button>
            </div>
        @endif

    </div>

</form>

@if($filter->id)
    <div class="collapse text-right" id="moreOptionsContainer">

        <hr>

        <form action="{{ route("admin.reports.datasets.filters.destroy", [$report, $dataset, $filter]) }}" method="POST" class="confirm-delete-form" data-delete-item-title="{{ $filterDescriptor->descriptorForFilter($filter) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">
                {!! \App\icon\trash() !!}
                {{ __('admin.deleteFilter') }}
            </button>
        </form>

    </div>
@endif
