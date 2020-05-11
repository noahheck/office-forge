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

    @foreach ($fields as $field)

        @if ($field->separator)
            <hr class="separator">
        @endif

        @include('_form_field.' . $field->field_type, [
            'field' => $field,
            'value' => optional($values->firstWhere('form_doc_template_field_id', $field->id)),
            'autofocus' => $loop->first,
        ])

    @endforeach

    <hr>

    <button type="submit" class="btn btn-primary" name="save_draft" value="1">
        {{ __('app.saveDraft') }}
    </button>

    <button type="submit" class="btn btn-primary" name="save_submit" value="1">
        {{ __('app.saveSubmit') }}
    </button>

    <a class="btn btn-secondary" href="{{ old('return', url()->previous()) }}">
        {{ __('app.cancel') }}
    </a>

</form>
