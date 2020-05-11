@extends("layouts.app")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\FormDocs\Create)
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 document-container">

            <div class="card shadow document">
                <div class="card-body">

                    <h2>{{ $formDoc->name }}</h2>

                    @if ($file)
                        <h5 class="pl-3">{!! $file->icon(['mr-2']) !!}{{ $file->name }}</h5>
                    @endif

                    <hr>

                    @include('form-docs._form', [
                        'action' => route('form-docs.store'),
                        'fields' => $template->fields,
                        'values' => $formDoc->fields,
                    ])

                </div>
            </div>
        </div>
    </div>
@endsection
