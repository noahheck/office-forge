<form class="bold-labels" method="POST" action="{{ $action }}">

    @csrf

    @if($method ?? false)
        @method($method)
    @endif

    @hiddenField([
        'name' => 'file_id',
        'value' => $formDoc->file_id,
    ])

    @hiddenField([
        'name' => 'form_doc_template_id',
        'value' => $formDoc->form_doc_template_id,
    ])

    @hiddenField([
        'name' => 'return',
        'value' => old('return', url()->previous()),
    ])

    <div class="row">

        <div class="col-6">
            @dateField([
                'name' => 'date',
                'label' => __('app.date'),
                'details' => '',
                'value' => old('date', $formDoc->date),
                'placeholder' => '',
                'required' => true,
                'autofocus' => false,
                'error' => $errors->has('date'),
                'readonly' => false,
            ])
        </div>

        <div class="col-6">
            @timeField([
                'name' => 'time',
                'label' => __('app.time'),
                'details' => '',
                'value' => old('time', $formDoc->time),
                'placeholder' => '',
                'required' => true,
                'autofocus' => false,
                'error' => $errors->has('time'),
                'readonly' => false,
            ])
        </div>

    </div>

    <hr>

    @foreach ($fields as $field)

        @include('_form_field.' . $field->field_type, [
            'field' => $field,
            'value' => optional($values->firstWhere($valueKey, $field->id)),
            'autofocus' => $loop->first,
        ])

    @endforeach

    <hr>

    <div class="d-flex">

        <div class="flex-grow-1">

            <button type="submit" class="btn btn-primary" name="save_draft" value="1">
                {{ __('app.saveDraft') }}
            </button>

            <button type="submit" class="btn btn-primary" name="save_submit" value="1">
                {{ __('app.saveSubmit') }}
            </button>

            <a class="btn btn-secondary" href="{{ old('return', url()->previous()) }}">
                {{ __('app.cancel') }}
            </a>

        </div>

        @can('delete', $formDoc)
            <div>
                <button type="button" class="btn btn-outline-primary" data-toggle="collapse" data-target="#moreOptionsContainer">
                    {{ __('app.moreOptions') }}
                    {!! \App\icon\chevronDown() !!}
                </button>
            </div>
        @endcan

    </div>

</form>

@can('delete', $formDoc)
    <div class="collapse text-right" id="moreOptionsContainer">

        <hr>

        <form action="{{ route('form-docs.destroy', [$formDoc]) }}" method="POST" class="confirm-delete-form" data-delete-item-title="{{ $formDoc->name }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">
                {!! \App\icon\trash() !!}
                {{ __('formDoc.deleteFormDoc') }}
            </button>
        </form>

    </div>
@endcan
