@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Drives\Edit($drive),
])

@section('content')

    <div class="row justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h1>
                {!! \App\icon\drive(['mr-2']) !!}{{ __('admin.editDrive') }}
            </h1>

            <p class="text-muted">{{ __('admin.editDrive_shortDescription') }}</p>

            <div class="card document">
                <div class="card-body">

                    @include('admin.drives._form', [
                        'action' => route('admin.drives.update', [$drive]),
                        'method' => 'PUT',
                    ])

                </div>
            </div>

        </div>

    </div>
@endsection
