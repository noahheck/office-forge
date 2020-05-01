@extends("layouts.app")

@push('styles')
    @style('css/files.css')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Files\Forms\Show($fileType, $file, $form)),
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 document-container">

            <div class="card shadow document">

                <div class="card-body">

                    <h1 class="h5">
                        {!! $fileType->icon() !!} {{ $file->name }}
                    </h1>

                    <hr>

                    <h2 class="h3">
                        {!! \App\icon\forms(['mr-2']) !!}{{ $form->name }}
                    </h2>

                    @formError

                    <hr>

                    <form class="bold-labels px-md-3 px-lg-4 px-xl-5" action="{{ route('files.forms.update', [$file, $form]) }}" method="POST">

                        @csrf

                        @method('PUT')

                        @hiddenField([
                            'name' => 'return',
                            'value' => old('return', url()->previous()),
                        ])

                        @foreach ($form->activeFields as $field)

                            @if ($field->separator)
                                <hr class="separator">
                            @endif

                            @include('_form_field.' . $field->field_type, [
                                'field' => $field,
                                'value' => optional($values->firstWhere('file_type_form_field_id', $field->id)),
                                'autofocus' => $loop->first,
                            ])

                        @endforeach

                        <hr>

                        <button type="submit" class="btn btn-primary">
                            {{ __('app.save') }}
                        </button>

                        <a class="btn btn-secondary" href="{{ old('return', url()->previous(route('files.show', [$file]))) }}">
                            {{ __('app.cancel') }}
                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection
