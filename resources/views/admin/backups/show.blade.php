@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Admin\Backups\Show($backup)),
])

@section('content')

    <div class="row justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h1>
                {!! \App\icon\backups(['mr-2']) !!}{{ __('admin.backups_backup') }}
            </h1>

            <p class="text-muted">{{ __('admin.backups_backup_shortDescription') }}</p>

            <div class="card document">
                <div class="card-body">

                    <dl>

                        <dt>{{ __('admin.backups_startTime') }}</dt>
                        <dd>{{ \App\format_datetime($backup->started) }}</dd>

                        <dt>{{ __('admin.backups_completedTime') }}</dt>
                        <dd>{{ \App\format_datetime($backup->completed) }}</dd>

                        <dt>{{ __('admin.backups_successful') }}</dt>
                        <dd>
                            @if ($backup->successful)
                                {!! \App\icon\circleCheck(['text-success']) !!}
                            @else
                                {!! \App\icon\warning(['text-danger']) !!}
                            @endif
                        </dd>

                        <dt>{{ __('admin.backups_fileSize') }}</dt>
                        <dd>{{ \App\format_filesize($backup->filesize) }}</dd>



                    </dl>

                    <hr>

                    @if ($backup->successful)

                        <div class="text-center">
                            <a class="btn btn-primary" href="{{ route('admin.backups.download', [$backup]) }}" target="_blank">
                                {!! \App\icon\mediaFileDownload(['d-block', 'fs-48px', 'mb-3', 'mt-3']) !!}
                                {{ __('admin.backups_downloadBackupFile') }}
                            </a>
                        </div>

                    @else

                        <p>
                            <strong>Error:</strong>
                        </p>

                        <p>
                            {!! nl2br(e($backup->error)) !!}
                        </p>

                    @endif

                </div>
            </div>

        </div>

    </div>



@endsection
