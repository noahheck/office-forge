@extends("layouts.app")

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Files\Access($fileType, $file))
])

@push('styles')
    @style('css/files.css')
@endpush

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-sm-10 col-md-8 col-xl-6">

            <h1>
                {!! \App\icon\accessLock(['mr-2']) !!}{{ __('app.accessDetails') }} {{ $fileType->name }}
            </h1>


            <div class="card shadow">
                <div class="card-body">

                    {!! $file->icon(['mr-2']) !!}{{ $file->name }}

                    <hr>

                    @forelse ($fileType->teams as $team)
                        @if ($loop->first)
                            <p>
                                <strong>{{ __('file.filesOfTypeRestrictedByTeams', ['type' => $file->fileType->name]) }}</strong>
                            </p>

                            <ul class="list-group">
                        @endif

                            <li class="list-group-item">{!! $team->icon() !!} {{ $team->name }}</li>

                        @if ($loop->last)
                            </ul>
                        @endif
                    @empty
                        <p>
                            <em>{{ __('file.filesOfTypeNoTeamRestrictions', ['type' => $file->fileType->name]) }}</em>
                        </p>
                    @endforelse

                    <hr>

                    @forelse ($file->accessLocks as $accessLock)
                        @if ($loop->first)
                            <p>
                                <strong>{{ __('file.fileOfTypeRestrictedByAccessLocks', ['type' => $fileType->name]) }}</strong>
                            </p>

                            <ul class="list-group">

                        @endif

                            <li class="list-group-item">
                                {!! \App\icon\lock(['mr-2']) !!}{{ $accessLock->name }}
                            </li>

                        @if ($loop->last)
                            </ul>
                        @endif
                    @empty
                        <p>
                            <em>{{ __('file.fileOfTypeNoAccessLockRestrictions', ['type' => $fileType->name]) }}</em>
                        </p>
                    @endforelse

                    <hr>

                    <p>
                        <strong>
                            {{ __('file.fileOfTypeAccessibleByUsers', ['type' => $fileType->name]) }}
                        </strong>
                    </p>

                    @foreach ($accessingUsers as $accessingUser)
                        @if ($loop->first)
                            <ul class="list-group">
                        @endif
                            <li class="list-group-item d-flex">
                                <div>
                                    {!! $accessingUser->icon(['sssmhw-35p']) !!}
                                </div>
                                <div class="pl-3">
                                    <h6>
                                        @if ($accessingUser->administrator)
                                            {!! \App\icon\userAdmin(['mr-1']) !!}
                                        @endif
                                        {!! $accessingUser->name !!}
                                    </h6>
                                    <div class="fs-12px">
                                        @foreach ($accessingUser->teams as $userTeam)
                                            {!! $userTeam->icon() !!}
                                        @endforeach
                                        @foreach ($accessingUser->accessKeysForFileType($fileType) as $key)
                                            <span class="border rounded mr-1 p-1" style="white-space: nowrap;">
                                                {!! \App\icon\accessKey(['mr-1']) !!}{{ $key->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </li>
                        @if ($loop->last)
                            </ul>
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>

@endsection
