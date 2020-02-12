@extends("layouts.settings")

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar())
                    ->addLink(new \App\Navigation\Link\Settings\MySettings)
                    ->setCurrentLocation(__('app.teams')),
])

@section('my-settings-content')

    <h2>{{ __('app.teams') }}</h2>

    @if($teams->count() > 0)
        <p>{{ __('settings.memberOfTheseTeams') }}</p>

        <ul class="list-group">
            @foreach ($teams as $team)
                <li class="list-group-item">
                    {!! $team->icon() !!} {{ $team->name }}
                </li>
            @endforeach
        </ul>

    @else
        <p>{{ __('settings.notAMemberOfAnyTeams') }}</p>
    @endif

@endsection
