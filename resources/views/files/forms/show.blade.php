@extends("layouts.app")

@push('styles')
    @style('css/files.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Files\Forms\Show($fileType, $file, $form)),
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <div class="card shadow">

                <div class="card-body">

                    <h1 class="h5">
                        {!! $fileType->icon() !!} {{ $file->name }}
                    </h1>

                    <hr>

                    <h2 class="h3">
                        <span class="far fa-list-alt mr-2"></span>{{ $form->name }}
                    </h2>

                    <hr>

                    <form class="bold-labels px-md-3 px-lg-4 px-xl-5" action="{{ route('files.forms.update', [$file, $form]) }}" method="POST">

                        @csrf

                        @method('PUT')

                        @hiddenField([
                            'name' => 'return',
                            'value' => url()->previous()
                        ])

                        @foreach ($form->activeFields as $field)

                            @if ($field->separator)
                                <hr class="separator">
                            @endif

                            @include('_form_field.' . $field->field_type, [
                                'field' => $field,
                                'value' => optional($values->firstWhere('file_type_form_field_id', $field->id)),
                            ])

                        @endforeach

                        <hr>

                        <button type="submit" class="btn btn-primary">
                            {{ __('app.save') }}
                        </button>

                        <a class="btn btn-secondary" href="{{ url()->previous(route('files.show', [$file])) }}">
                            {{ __('app.cancel') }}
                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection
