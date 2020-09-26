@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Backups\Index,
])

@section('content')
    <h1>
        {!! \App\icon\backups(['mr-2']) !!}{{ __('admin.backups') }}
    </h1>

    <div class="card">
        <div class="card-body">
            <div class="d-sm-flex">

                <div class="flex-grow-1 p-2">
                    <p>{{ __('admin.backups_description') }}</p>
                    <p><em>{{ __('admin.backups_descriptionDatabaseOnly') }}</em></p>
                </div>

                <div class="flex-grow-0 text-right">
                    <div class="btn-group">

                        <a href="{{ route('admin.backups.settings') }}" class="btn btn-primary ws-nowrap">
                            {!! \App\icon\adminSettings(['mr-1']) !!}{{ __('admin.settings') }}
                        </a>
                        <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">{{ __('app.moreOptions') }}</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <form action="{{ route('admin.backups.generate') }}" method="POST">
                                @csrf

                                <button type="submit" class="dropdown-item">
                                    {{ __('admin.backups_generateBackupNow') }}
                                </button>
                            </form>

                        </div>

                    </div>

                </div>
            </div>

            <hr>

            <div class="table-responsive">
                <table id="backups" class="table table-striped table-bordered dt-table">
                    <thead>
                        <tr>
                            <th class="w-100p text-center">{{ __('admin.backups_successful') }}</th>
                            <th>{{ __('admin.backups_startTime') }}</th>
                            <th>{{ __('admin.backups_completedTime') }}</th>
                            <th class="">{{ __('admin.backups_filename') }}</th>
                            <th class="w-100p">{{ __('admin.backups_fileSize') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($backups as $backup)
                            <tr>
                                <td class="text-center">
                                    @if ($backup->successful)
                                        {!! \App\icon\checkedBox() !!}
                                    @else
                                        {!! \App\icon\uncheckedBox() !!}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.backups.show', [$backup]) }}">
                                        {{ \App\format_datetime($backup->started) }}
                                    </a>
                                </td>
                                <td>{{ \App\format_datetime($backup->completed) }}</td>
                                <td>
                                    {{ $backup->filename }}
                                </td>
                                <td>
                                    {{ \App\format_filesize($backup->filesize) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
