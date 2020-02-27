@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FileTypes\Forms\Fields\Create($fileType, $form),
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <h1>
                <span class="fas fa-pen-square"></span> {{ __('admin.newField') }}
            </h1>

            <p class="text-muted">{{ __('admin.newField_shortDescription') }}</p>

            <div class="card">
                <div class="card-body">

                    @include('admin.file-types.forms.fields._form', [
                        'action' => route('admin.file-types.forms.fields.store', [$fileType, $form]),
                        /*'taskAction' => $action,
                        'showActive' => false,*/
                    ])

                </div>
            </div>

        </div>
    </div>
@endsection
