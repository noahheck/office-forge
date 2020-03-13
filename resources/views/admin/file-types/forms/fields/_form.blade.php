<form action="{{ $action }}" method="POST" class="bold-labels">
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

            @if ($showActive ?? false)

                <hr>

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
