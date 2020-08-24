@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Drives\Index(),
])

@section('content')
    <h1>
        {!! \App\icon\drive(['mr-2']) !!}{{ __('fileStore.drives') }}
    </h1>

    <div class="card">
        <div class="card-body">
            @if($drives->count() > 0)
                <div class="text-right">
                    <a href="{{ route('admin.drives.create') }}" class="btn btn-primary">
                        {!! \App\icon\circlePlus(['mr-1']) !!}{{ __('admin.newDrive') }}
                    </a>
                </div>
                <hr>
                <div class="table-responsive">
                    <table id="users" class="table table-striped table-bordered dt-table">
                        <thead>
                            <tr>
                                <th>{{ __('fileStore.drive_name') }}</th>
                                <th>{{ __('fileStore.drive_teamAccessApproval') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($drives as $drive)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.drives.edit', [$drive]) }}">
                                            {{ $drive->name }}
                                        </a>
                                    </td>
                                    <td>
                                        @foreach ($drive->teams as $team)
                                            {!! $team->icon() !!}
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="row justify-content-center">

                    <div class="col-12 col-md-6 col-lg-6 col-xl-5">

                        <div class="card">
                            <div class="card-body text-center">

                                <div class="empty-resource">
                                    {!! \App\icon\drive(['empty-resource-icon']) !!}
                                </div>

                                <p>{{ __('admin.fileStore_description') }}</p>
                                <p>{{ __('admin.fileStore_driveDescription') }}</p>
                                <p>{{ __('admin.fileStore_versionsDescription') }}</p>

                                <hr>

                                <a class="btn btn-primary" href="{{ route('admin.drives.create') }}">{{ __('admin.fileStore_createFirstDriveNow') }}</a>
                            </div>
                        </div>

                    </div>

                </div>
            @endif
        </div>
    </div>
@endsection
