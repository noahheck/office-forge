@extends("layouts.app")

@push('styles')
    @style('css/files.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Files\Forms\Index($fileType, $file)),
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <div class="card shadow">

                <div class="card-body">

                    <h1 class="h2">
                        {!! $fileType->icon() !!} {{ $file->name }}
                    </h1>

                    <hr>

                    <h2 class="h4">
                        <span class="far fa-list-alt mr-2"></span>{{ __('file.forms') }}
                    </h2>

                    @if ($forms->count() > 0)

                        <div class="list-group">
                            @foreach ($forms as $form)

                                <a class="list-group-item list-group-item-action" href="#">
                                    {{ $form->name }}
                                </a>

                            @endforeach
                        </div>

                    @else

                        <hr>

                        <p>{{ __('admin.form_description') }}</p>

                        <p>{{ __('file.form_noFormsToView') }}</p>

                    @endif

                </div>

            </div>

        </div>

    </div>

@endsection
