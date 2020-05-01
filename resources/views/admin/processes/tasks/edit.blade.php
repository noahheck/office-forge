@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Processes\Tasks\Edit($process, $task),
])

@section('content')

    <div class="row justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h1>
                {!! \App\icon\tasks(['mr-2']) !!}{{ __('admin.editTask') }}
            </h1>

            <p class="text-muted">{{ __('admin.editTask_shortDescription') }}</p>

            <div class="card document">
                <div class="card-body">

                    @include('admin.processes.tasks._form', [
                        'action' => route('admin.processes.tasks.update', [$process, $task, 'return' => url()->previous()]),
                        'method' => 'PUT',
                        'showActive' => true,
                    ])

                </div>
            </div>

        </div>
    </div>
@endsection
