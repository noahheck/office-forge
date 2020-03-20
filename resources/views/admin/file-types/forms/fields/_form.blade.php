@push('scripts')
    @script('js/page.admin.file-types.forms.fields._form.js')
@endpush

<form action="{{ $action }}" method="POST" class="bold-labels file-type-form-field-form">
    @csrf

    @if($method ?? false)
        @method($method)
    @endif

    @hiddenField([
        'name' => 'return',
        'value' => url()->previous(),
    ])

    <div class="row">

        <div class="col-12">

            @errors('label', 'description', 'field_type')

            @textField([
                'name' => 'label',
                'label' => __('file.field_label'),
                'details' => __('file.field_labelDescription'),
                'value' => old('name', $field->label),
                'placeholder' => __('file.field_labelExamples'),
                'required' => true,
                'autofocus' => true,
                'error' => $errors->has('label'),
            ])

            @textareaField([
                'name' => 'description',
                'label' => __('file.field_description'),
                'details' => __('file.field_descriptionDescription'),
                'value' => $field->description,
                'placeholder' => '',
                'rows' => 2,
                'required' => false,
                'autofocus' => false,
                'error' => $errors->has('description'),
            ])

            @selectField([
                'name' => 'field_type',
                'label' => __('file.field_fieldType'),
                'details' => __('file.field_fieldTypeDescription'),
                'value' => $field->field_type,
                'options' => \App\filetype_field_options(),
                'placeholder' => 'string: example placeholder text',
                'required' => true,
                'autofocus' => false,
                'error' => $errors->has('field_type'),
            ])

            <div class="form-field-option row justify-content-center hidden" id="form-field-options_select" style="display: none;">

                <div class="col-10">

                    <div class="card shadow">

                        <div class="card-header">
                            <h5>{{ __('file.field_fieldTypeSelect_options') }}</h5>
                        </div>

                        <div class="card-body">

                            <div class="input-group">
                                <input type="text" id="newSelectOption" class="form-control" placeholder="{{ __('file.field_fieldTypeSelect_addOption') }}" aria-label="{{ __('file.field_fieldTypeSelect_addOption') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" id="addNewSelectOption">{{ __('file.field_fieldTypeSelect_addOption') }}</button>
                                </div>
                            </div>

                            <ul class="list-group mt-3" id="selectOptionsList">

                                @foreach ($field->selectOptions() as $option)
                                    <li class="list-group-item select-option-item d-flex">
                                        <span class="select-option-text flex-grow-1">{{ $option }}</span>
                                        <button type="button" class="btn btn-sm btn-outline-danger delete-button mr-3">
                                            <span class="far fa-trash-alt pt-1"></span>
                                        </button>
                                        <span class="fas fa-arrows-alt-v sort-handle ml-2 pt-2"></span>
                                        <input type="hidden" name="select_options[]" value="{{ $option }}">
                                    </li>
                                @endforeach

                            </ul>



                        </div>

                    </div>

                </div>

            </div>

            <hr>

            @checkboxSwitchField([
                'name' => 'separator',
                'id' => 'field_separator',
                'label' => __('file.field_separator'),
                'details' => __('file.field_separatorDescription'),
                'checked' => $field->separator,
                'value' => '1',
                'required' => false,
                'error' => $errors->has('separator'),
            ])

            @if ($showActive ?? false)

                @checkboxSwitchField([
                    'name' => 'active',
                    'id' => 'field_active',
                    'label' => __('file.field_active'),
                    'details' => __('file.field_activeDescription'),
                    'checked' => $field->active,
                    'value' => '1',
                    'required' => false,
                    'error' => $errors->has('active'),
                ])

            @endif



        </div>

    </div>

    <hr>

    <button type="submit" class="btn btn-primary">
        {{ __('app.save') }}
    </button>

    <a class="btn btn-secondary" href="{{ url()->previous(route('admin.file-types.forms.index', [$fileType, $form])) }}">
        {{ __('app.cancel') }}
    </a>

</form>

<ul class="template">
    <li class="list-group-item select-option-item d-flex" id="newSelectOptionTemplate">
        <span class="select-option-text flex-grow-1"></span>
        <button type="button" class="btn btn-sm btn-outline-danger delete-button mr-3">
            <span class="far fa-trash-alt pt-1"></span>
        </button>
        <span class="fas fa-arrows-alt-v sort-handle ml-2 pt-2"></span>
        <input type="hidden" name="select_options[]" value="">
    </li>

</ul>
