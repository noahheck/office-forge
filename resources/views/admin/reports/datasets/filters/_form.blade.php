@push('scripts')
{{--    @script('js/page.admin.reports.datasets._form.js')--}}
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

            <p>
                {{ __('admin.filter_filterFormInformation', ['dataset' => $dataset->name, 'dataType' => $dataset->datasetable->name]) }}
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
                            <option value="{{ $field['value'] }}" data-type="{{ $field['type'] }}" {{ ($field['value'] == $filter->field_id) ? 'selected' : '' }}>{{ $field['label'] }}</option>
                        @endforeach

                        @if ($optgroup)
                            </optgroup>
                        @endif
                    @endforeach
                </select>
            </div>

            @selectField([
                'name' => 'operator',
                'label' => __('admin.filter_operator'),
                'details' => '',
                'value' => '',
                'options' => \App\Report\Dataset\Filter::operatorOptions(),
                'placeholder' => '',
                'required' => true,
                'autofocus' => false,
                'error' => $errors->has('operator'),
                'readonly' => false,
                'fieldOnly' => false,
            ])

        </div>

    </div>

    <hr>

    <button type="submit" class="btn btn-primary">
        {{ __('app.save') }}
    </button>

    <a class="btn btn-secondary" href="{{ url()->previous(route('admin.reports.show', [$report])) }}">
        {{ __('app.cancel') }}
    </a>

</form>
