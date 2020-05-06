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
        'value' => old('return', url()->previous()),
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

            <div class="form-field-option row justify-content-center hidden" id="form-field-options_file" style="display: none;">

                <div class="col-10">
                    <div class="card shadow">

                        <div class="card-header">
                            <h5>{{ __('file.field_fieldTypeFile') }} {{ __('app.options') }}</h5>
                        </div>

                        <div class="card-body">

                            @fileTypeSelectField([
                                'name' => 'file_type',
                                'label' => __('file.field_fieldTypeFile_fileType'),
                                'value' => (int) $field->fileTypeId(),
                                'fileTypes' => $allFileTypes,
                                'placeholder' => __('file.field_fieldTypeFile_fileType'),
                                'description' => __('file.field_fieldTypeFile_fileTypeDescription'),
                                'required' => false,
                                'autofocus' => false,
                                'error' => $errors->has('file_type'),
                            ])

                        </div>

                    </div>
                </div>

            </div>

            <div class="form-field-option row justify-content-center hidden" id="form-field-options_user" style="display: none;">

                <div class="col-10">
                    <div class="card shadow">

                        <div class="card-header">
                            <h5>{{ __('file.field_fieldTypeUser') }} {{ __('app.options') }}</h5>
                        </div>

                        <div class="card-body">

                            @teamSelectField([
                                'name' => 'user_team',
                                'label' => __('file.field_fieldTypeUser_memberOfTeam'),
                                'value' => (int) $field->userTeam(),
                                'teams' => $allTeams,
                                'placeholder' => __('file.field_fieldTypeUser_memberOfTeam'),
                                'description' => __('file.field_fieldTypeUser_memberOfTeamDescription'),
                                'required' => false,
                                'autofocus' => false,
                                'error' => $errors->has('user_team'),
                            ])

                        </div>

                    </div>
                </div>

            </div>

            <div class="form-field-option row justify-content-center hidden" id="form-field-options_decimal" style="display: none;">

                <div class="col-10">
                    <div class="card shadow">

                        <div class="card-header">
                            <h5>{{ __('file.field_fieldTypeDecimal') }} {{ __('app.options') }}</h5>
                        </div>

                        <div class="card-body">

                            @selectField([
                                'name' => 'decimal_places',
                                'label' => __('file.field_fieldTypeDecimal_numberOfDecimalPlaces'),
                                'details' => '',
                                'value' => (int) $field->decimalPlaces(),
                                'options' => ['1' => '1', '2' => '2', '3' => '3', '4' => '4'],
                                'placeholder' => '',
                                'required' => true,
                                'autofocus' => false,
                                'error' => $errors->has('decimal_places'),
                                'readonly' => false,
                            ])

                        </div>
                    </div>
                </div>

            </div>

            <div class="form-field-option row justify-content-center hidden" id="form-field-options_select" style="display: none;">

                <div class="col-10">

                    <div class="card shadow">

                        <div class="card-header">
                            <h5>{{ __('file.field_fieldTypeSelect') }} {{ __('app.options') }}</h5>
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

    <a class="btn btn-secondary" href="{{ old('return', url()->previous(route('admin.index'))) }}">
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
