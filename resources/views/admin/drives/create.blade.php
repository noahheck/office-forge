@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Drives\Create(),
])

@section('content')

    <div class="row justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h1>
                {!! \App\icon\drive(['mr-2']) !!}{{ __('admin.newDrive') }}
            </h1>

            <p class="text-muted">{{ __('admin.newDrive_shortDescription') }}</p>

            <div class="card document">
                <div class="card-body">

                    @include('admin.drives._form', [
                        'action' => route('admin.drives.store'),
                    ])

                </div>
            </div>

        </div>

    </div>
@endsection
