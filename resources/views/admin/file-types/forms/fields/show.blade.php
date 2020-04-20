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
                        <span class="fas fa-pen-square"></span> {{ $field->label }}
                    </h2>

                    <hr>

                    <div class="d-flex justify-content-between">

                        <span>
                            <span class="far fa-{{ $field->active ?? false ? 'check-' : '' }}square"></span> {{ __('file.field_active') }}
                        </span>

                        <a href="{{ route('admin.file-types.forms.fields.edit', [$fileType, $form, $field]) }}" class="btn btn-sm btn-primary">
                            <span class="fas fa-edit"></span> {{ __('admin.editField') }}
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
