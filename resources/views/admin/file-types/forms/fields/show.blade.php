@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FileTypes\Forms\Fields\Show($fileType, $form, $field),
])

@section('content')

    <div class="row justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">

            <div class="card document">
                <div class="card-body">

                    <h2>
                        {!! \App\icon\formFields(['mr-2']) !!}{{ $field->label }}
                    </h2>

                    <hr>

                    <div class="d-flex justify-content-between">

                        <span>
                            @if ($field->active)
                                {!! \App\icon\checkedBox(['mr-2']) !!}{{ __('file.field_active') }}
                            @else
                                {!! \App\icon\uncheckedBox(['mr-2']) !!}{{ __('file.field_active') }}
                            @endif
                        </span>

                        <a href="{{ route('admin.file-types.forms.fields.edit', [$fileType, $form, $field]) }}" class="btn btn-sm btn-primary">
                            {!! \App\icon\edit(['mr-1']) !!}{{ __('admin.editField') }}
                        </a>

                    </div>

                    <hr>

                    <dl>
                        <dt>{{ __('file.field_description') }}</dt>
                        <dd>{{ $field->description }}</dd>

                        <dt>{{ __('file.field_fieldType') }}</dt>
                        <dd>{{ \App\filetype_field_options()[$field->field_type] }}</dd>
                    </dl>

                </div>

            </div>

        </div>
    </div>
@endsection
