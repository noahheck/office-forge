@extends("layouts.settings")

@section('my-settings-content')

    <h3>Teams</h3>

    <hr>

    @if($teams->count() > 0)
        <p>You are a member of the following teams:</p>

        <ul class="list-group">
            @foreach ($teams as $team)
                <li class="list-group-item">
                    {!! $team->icon() !!} {{ $team->name }}
                </li>
            @endforeach
        </ul>

    @else
        <p>You are not a member of any teams.</p>
    @endif

@endsection
