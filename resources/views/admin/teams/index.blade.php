@extends("layouts.admin")

@section('content')
    <h1>
        <span class="fas fa-user-friends"></span> Teams
    </h1>

    <div class="card">
        <div class="card-body">
            @if($teams->count() > 0)
                <div class="text-right">
                    <a href="{{ route('admin.teams.create') }}" class="btn btn-primary">
                        <span class="fas fa-plus-circle"></span> New Team
                    </a>
                </div>
                <hr>
                <div class="table-responsive">
                    <table id="users" class="table table-striped table-bordered dt-table">
                        <thead>
                            <tr>
                                <th>Team</th>
                                <th>Members</th>
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
            </div>
        @else
            <div class="row justify-content-center">

                <div class="col-12 col-md-6 col-lg-6 col-xl-5">

                    <div class="card">
                        <div class="card-body text-center">

                            <div class="empty-resource">
                                <span class="fas fa-user-friends empty-resource-icon"></span>
                            </div>

                            <p>Teams help you organize your staff members into functional groups so they can work together better. Teams help you communicate more effectively, and are used to help organize access to information.</p>
                            <p>You can create as many teams as you need!</p>

                            <hr>

                            <a class="btn btn-primary" href="{{ route('admin.teams.create') }}">Create your first team now!</a>
                        </div>
                    </div>

                </div>

            </div>
        @endif
    </div>
@endsection
