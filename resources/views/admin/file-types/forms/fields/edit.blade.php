@extends("layouts.admin")

@push('styles')
    @style('css/admin.files.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FileTypes\Forms\Fields\Edit($fileType, $form, $field),
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <h1>
                <span class="fas fa-pen-square"></span> {{ __('admin.editField') }}
            </h1>

            <p class="text-muted">{{ __('admin.editField_shortDescription') }}</p>

            <div class="card">
                <div class="card-body">

                    @include('admin.file-types.forms.fields._form', [
                        'action' => route('admin.file-types.forms.fields.update', [$fileType, $form, $field]),
                        'method' => 'PUT',
                        'showActive' => true,
                    ])

                </div>
            </div>

        </div>
    </div>
@endsection
