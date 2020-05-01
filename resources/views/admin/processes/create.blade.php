@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Processes\Create(),
])

@section('content')

    <div class="row justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h1>
                {!! \App\icon\processes(['mr-2']) !!}{{ __('admin.newProcess') }}
            </h1>

            <p class="text-muted">{{ __('admin.newProcess_shortDescription') }}</p>

            <div class="card document">
                <div class="card-body">

                    @include('admin.processes._form', [
                        'action' => route('admin.processes.store'),
                    ])

                </div>
            </div>

        </div>

    </div>
@endsection
