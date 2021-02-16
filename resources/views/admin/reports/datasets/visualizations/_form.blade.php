@push('scripts')
    @script('js/page.admin.reports.datasets.visualizations._form.js')
@endpush

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

            {{--<p>
                {!! __('admin.dataset_field_fieldFormInformation', ['dataset' => e($dataset->name), 'dataTypeIcon' => $dataset->datasetable->icon(), 'dataType' => e($dataset->datasetable->name)]) !!}
            </p>--}}

{{--            <hr>--}}

            {{--<div class="form-group required">
                <label for="field_id">{{ __('admin.dataset_field_fieldToAppear') }}</label>
                <select class="custom-select" id="field_id" name="field_id" autofocus>
                    <option value="">--</option>
                    @foreach ($dataset->datasetable->reportableFieldOptions() as $optgroup => $fields)
                        @if ($optgroup)
                            <optgroup label="{{ $optgroup }}">
                        @endif

                        @foreach ($fields as $fieldOption)
                            <option value="{{ $fieldOption['value'] }}" data-type="{{ $fieldOption['type'] }}" {{ ($fieldOption['value'] == $field->field_id) ? 'selected' : '' }}>{{ $fieldOption['label'] }}</option>
                        @endforeach

                        @if ($optgroup)
                            </optgroup>
                        @endif
                    @endforeach
                </select>
            </div>--}}

            @textField([
                'name' => 'label',
                'label' => __('admin.dataset_visualization_label'),
                'details' => __('admin.dataset_visualization_labelDescription'),
                'value' => old('label', $visualization->label),
                'placeholder' => '',
                'inputGroupAppendText' => '',
                'required' => true,
                'autofocus' => true,
                'error' => $errors->has('label'),
                'readonly' => false,
                'fieldOnly' => false,
            ])

            @selectField([
                'name' => 'type',
                'id' => 'visualization_type',
                'label' => __('admin.dataset_visualization_type'),
                'details' => '',
                'value' => old('type', $visualization->type),
                'options' => $visualization->visualizationTypeOptions(),
                'placeholder' => __('admin.dataset_visualization_type'),
                'required' => true,
                'autofocus' => false,
                'error' => $errors->has('type'),
                'readonly' => false,
                'fieldOnly' => false,
            ])



            <div class="visualization-type-options-container" id="visualizationTypeOptionsContainer">

                <div class="visualization-type-options d-none" id="total_recordsOptions">

                </div>

                <div class="visualization-type-options d-none" id="sum_averageOptions">
                    @selectField([
                        'name' => 'sum_average_field_id',
                        'id' => 'sum_average_field_id',
                        'label' => 'Which Report field do you want to apply this operation to?',
                        'details' => '',
                        'value' => old('sum_average_field_id', $visualization->field_id),
                        'options' => $dataset->sumOrAverageableFieldOptions()->pluck('label', 'id'),
                        'placeholder' => 'Select a field',
                        'required' => false,
                        'autofocus' => false,
                        'error' => $errors->has('sum_average_field_id'),
                        'readonly' => false,
                        'fieldOnly' => false,
                    ])
                </div>



                <div class="visualization-type-options d-none" id="aggregateOptions">

                    @selectField([
                        'name' => 'aggregate_field_id',
                        'id' => 'aggregate_field_id',
                        'label' => 'Which Report field do you want to apply this operation to?',
                        'details' => '',
                        'value' => old('aggregate_field_id', $visualization->field_id),
                        'options' => $dataset->aggregateFieldOptions()->pluck('label', 'id'),
                        'placeholder' => 'Select a field',
                        'required' => false,
                        'autofocus' => false,
                        'error' => $errors->has('aggregate_field_id'),
                        'readonly' => false,
                        'fieldOnly' => false,
                    ])

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

        @if ($visualization->id)
            <div class="flex-grow-0">
                <button type="button" class="btn btn-outline-primary" data-toggle="collapse" data-target="#moreOptionsContainer">
                    {{ __('app.moreOptions') }}
                    {!! \App\icon\chevronDown() !!}
                </button>
            </div>
        @endif

    </div>

</form>

@if($visualization->id)
    <div class="collapse text-right" id="moreOptionsContainer">

        <hr>

        <form action="{{ route("admin.reports.datasets.visualizations.destroy", [$report, $dataset, $visualization]) }}" method="POST" class="confirm-delete-form" data-delete-item-title="{{ $visualization->label }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">
                {!! \App\icon\trash() !!}
                {{ __('admin.dataset_deleteVisualization') }}
            </button>
        </form>

    </div>
@endif
