@extends("layouts.admin")

@push('styles')
    @style('css/admin.server.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Admin\Server\Index),
])

@section('content')
    <h1>
        {!! \App\icon\server(['mr-2']) !!}{{ __('admin.server') }}
    </h1>

    <hr>

    <div class="row">
        <div class="col-12 col-md-6 mb-5">
            <div class="card shadow server-details-card">
                <div class="card-header d-flex">
                    <h4 class="mb-0 flex-grow-1">{!! \App\icon\server(['mr-2']) !!}{{ __('admin.server_operatingSystem') }}</h4>
                    <div class="flex-grow-0">
                        <div class="dropdown">
                            <a href='#' class="dropdown-toggle" id="updatesDropdownButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('admin.server_updates') }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="updatesDropdownButton">
                                <a class="dropdown-item" href="{{ route('admin.server.updates.settings') }}">{!! \App\icon\adminSettings(['fa-fw', 'mr-2']) !!}{{ __('admin.settings') }}</a>
                                <a class="dropdown-item" href="{{ route('admin.server.updates.history') }}">{!! \App\icon\history(['fa-fw', 'mr-2']) !!}{{ __('admin.server_history') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @forelse ($osDetails as $key => $value)
                        @if ($loop->first)
                            <dl>
                        @endif
                            <dt>{{ $key }}</dt>
                            <dd>{{ $value }}</dd>
                        @if ($loop->last)
                            </dl>
                        @endif

                    @empty
                        <p><em>{{ __('admin.server_noOSDetailsAvailable') }}</em></p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 mb-5">
            <div class="card shadow server-details-card">
                <div class="card-header d-flex">
                    <h4 class="mb-0 flex-grow-1">{!! \App\icon\php(['mr-2']) !!}{{ __('admin.server_php') }}</h4>
                    <a href="{{ route('admin.server.phpinfo') }}" class="flex-grow-0">{{ __('admin.server_php_viewPhpInfo') }}{!! \App\icon\go(['ml-2']) !!}</a>
                </div>
                <div class="card-body">
                    @forelse ($phpDetails as $key => $value)
                        @if ($loop->first)
                            <dl>
                        @endif
                            <dt>{{ __('admin.server_php_' . $key) }}</dt>
                            <dd>{{ (is_array($value)) ? implode(',', $value) : $value }}</dd>
                        @if ($loop->last)
                            </dl>
                        @endif

                    @empty
                        <p><em>{{ __('admin.server_noPHPDetailsAvailable') }}</em></p>
                    @endforelse
                </div>

            </div>

        </div>

        <div class="col-12 col-md-6 mb-5">
            <div class="card shadow server-details-card">
                <div class="card-header">
                    <h4 class="mb-0">{!! \App\icon\database(['mr-2']) !!}{{ __('admin.server_database') }}</h4>
                </div>
                <div class="card-body">
                    @forelse ($databaseDetails as $key => $value)
                        @if ($loop->first)
                            <dl>
                        @endif
                            <dt>{{ __('admin.server_database_' . $key) }}</dt>
                            <dd>{{ (is_array($value)) ? implode(',', $value) : $value }}</dd>
                        @if ($loop->last)
                            </dl>
                        @endif

                    @empty
                        <p><em>{{ __('admin.server_noDatabaseDetailsAvailable') }}</em></p>
                    @endforelse
                </div>

            </div>

        </div>

        <div class="col-12 col-md-6 mb-5">
            <div class="card shadow server-details-card">
                <div class="card-header">
                    <h4 class="mb-0">{!! \App\icon\diskDrive(['mr-2']) !!}{{ __('admin.server_diskDrive') }}</h4>
                </div>
                <div class="card-body">
                    @forelse ($diskDriveDetails as $key => $value)
                        @if ($loop->first)
                            <dl>
                        @endif
                            <dt>{{ __('admin.server_diskDrive_' . $key) }}</dt>
                            <dd>{{ (is_array($value)) ? implode(',', $value) : $value }}</dd>
                        @if ($loop->last)
                            </dl>
                        @endif

                    @empty
                        <p><em>{{ __('admin.server_noDiskDriveDetailsAvailable') }}</em></p>
                    @endforelse
                </div>

            </div>

        </div>


    </div>



@endsection
