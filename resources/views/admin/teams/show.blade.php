@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Teams\Show($team),
])

@section('content')
    <h1>
        {!! \App\icon\teams(['mr-2']) !!}{{ $team->name }}
    </h1>

    <div class="card">
        <div class="card-body">
            <div class="text-right">
                <a href="{{ route('admin.teams.edit', [$team]) }}" class="btn btn-primary">
                    {!! \App\icon\edit(['mr-1']) !!}{{ __('admin.editTeam') }}
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
