@extends("files.file_resource")

@push('styles')
    @style('css/files.css')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Files\Forms\Index($fileType, $file)),
])

@section('resource-content')

    {{--<div class="row justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">--}}

            <div class="card shadow document">

                <div class="card-body">

                    <h1 class="h2">
                        {!! $file->icon() !!} {{ $file->name }}
                    </h1>

                    <hr>

                    <h2 class="h4">
                        {!! \App\icon\forms(['mr-2']) !!}{{ __('file.forms') }}
                    </h2>

                    @if ($forms->count() > 0)

                        <div class="list-group">
                            @foreach ($forms as $form)

                                <a class="list-group-item list-group-item-action" href="{{ route('files.forms.show', [$file, $form]) }}">
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

        {{--</div>

    </div>--}}

@endsection
