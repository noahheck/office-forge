@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => (new \App\Html\LocationBar())
                    ->addLink(new \App\Html\LocationBar\Link\SystemSettings)
                    ->addLink(new \App\Html\LocationBar\Link\SystemSettings\Teams())
                    ->setCurrentLocation(e($team->name)),
])

@section('content')
    <h1>
        <span class="fas fa-user-friends"></span>
        {{ $team->name }}
    </h1>

    <div class="card">
        <div class="card-body">
            <div class="text-right">
                <a href="{{ route('admin.teams.edit', [$team]) }}" class="btn btn-primary">
                    <span class="fas fa-edit"></span> {{ __('admin.editTeam') }}
                </a>
            </div>

            <div class="row mt-3">
                <div class="col-12">

                    @foreach ($team->members as $member)
                        @if ($loop->first)
                            <ul class="list-group">
                        @endif

                            <li class="list-group-item">
                                {!! $member->icon() !!} {{ $member->name }}
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
