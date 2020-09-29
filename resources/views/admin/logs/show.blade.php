@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
    @style('css/admin.server.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Admin\Logs\Show($logFile)),
])

@section('content')

    <div class="row justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h1>
                {!! \App\icon\logs(['mr-2']) !!}{{ __('admin.logs') }}
            </h1>

            <p class="text-muted">{{ __('admin.logs_logFile_shortDescription') }}</p>

            <div class="card document">
                <div class="card-body">

                    <h3>{{ $logFile }}</h3>

                    <hr>

                    <div class="output-log">

                        {!! nl2br(e($logFileContent)) !!}

                    </div>

                </div>
            </div>

        </div>

    </div>



@endsection
