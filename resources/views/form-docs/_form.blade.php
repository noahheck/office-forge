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

        <div class="dropdown">

            <button type="button" class="btn btn-outline-danger dropdown-toggle" data-toggle="dropdown" id="deleteFormDocButton">
                {!! \App\icon\trash(['mr-1']) !!}{{ __('formDoc.deleteFormDoc') }}
            </button>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="deleteTaskButton">
                <form action="{{ route('form-docs.destroy', [$formDoc]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item text-danger">
                        {!! \App\icon\trash() !!}
                        {{ __('formDoc.deleteFormDocForGood') }}
                    </button>
                </form>
            </div>
        </div>

    </div>
@endcan
