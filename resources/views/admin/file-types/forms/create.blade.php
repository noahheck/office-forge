@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FileTypes\Forms\Create($fileType),
])

@section('content')

    <div class="row justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h1>
                {!! \App\icon\forms(['mr-2']) !!}{{ __('admin.newForm') }}
            </h1>

            <p class="text-muted">{{ __('admin.newForm_shortDescription') }}</p>

            <div class="card document">
                <div class="card-body">

                    @include('admin.file-types.forms._form', [
                        'action' => route('admin.file-types.forms.store', [$fileType]),
                    ])

                </div>
            </div>

        </div>
    </div>
@endsection
