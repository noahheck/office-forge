@extends("layouts.admin")

@section('content')
    <h1>
        <span class="fas fa-user-friends"></span> {{ __('app.teams') }}
    </h1>

    <div class="card">
        <div class="card-body">
            @if($teams->count() > 0)
                <div class="text-right">
                    <a href="{{ route('admin.teams.create') }}" class="btn btn-primary">
                        <span class="fas fa-plus-circle"></span> {{ __('admin.newTeam') }}
                    </a>
                </div>
                <hr>
                <div class="table-responsive">
                    <table id="users" class="table table-striped table-bordered dt-table">
                        <thead>
                            <tr>
                                <th>{{ __('app.team') }}</th>
                                <th>{{ __('app.members') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($teams as $team)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.teams.edit', [$team]) }}">
                                            {!! $team->icon() !!} {{ $team->name }}
                                        </a>
                                    </td>
                                    <td>
                                        @foreach ($team->members as $user)
                                            {!! $user->icon() !!}
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
                                    <span class="fas fa-user-friends empty-resource-icon"></span>
                                </div>

                                <p>{{ __('admin.team_description') }}</p>
                                <p>{{ __('admin.team_createAsManyAsWanted') }}</p>

                                <hr>

                                <a class="btn btn-primary" href="{{ route('admin.teams.create') }}">{{ __('admin.team_createFirstTeamNow') }}</a>
                            </div>
                        </div>

                    </div>

                </div>
            @endif
        </div>
    </div>
@endsection
