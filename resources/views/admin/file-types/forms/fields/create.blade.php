@extends("layouts.admin")

@push('styles')
    @style('css/admin.files.css')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FileTypes\Forms\Fields\Create($fileType, $form),
])


@section('content')

    <div class="row justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h1>
                {!! \App\icon\formFields(['mr-2']) !!}{{ __('admin.newField') }}
            </h1>

            <p class="text-muted">{{ __('admin.newField_shortDescription') }}</p>

            <div class="card document">
                <div class="card-body">

                    @include('admin.file-types.forms.fields._form', [
                        'action' => route('admin.file-types.forms.fields.store', [$fileType, $form]),
                    ])

                </div>
            </div>

        </div>
    </div>
@endsection
