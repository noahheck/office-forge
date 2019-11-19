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

    {{--<h3>Change your password</h3>

    <hr>

    <form action="{{ route('my-settings.password.update') }}" method="POST" class="bold-labels">
        @csrf

        @errors('current_password', 'new_password', 'new_password_confirmation')

        @passwordField([
            'name' => 'current_password',
            'label' => 'Current Password',
            'value' => '',
            'placeholder' => 'Current password',
            'required' => true,
            'autofocus' => false,
            'error' => $errors->has('current_password'),
        ])

        @passwordField([
            'name' => 'new_password',
            'label' => 'New Password',
            'value' => '',
            'placeholder' => 'Choose a strong password',
            'required' => true,
            'autofocus' => false,
            'error' => $errors->has('new_password'),
        ])

        @passwordField([
            'name' => 'new_password_confirmation',
            'label' => 'Confirm Password',
            'value' => '',
            'placeholder' => 'Same as above',
            'required' => true,
            'autofocus' => false,
            'error' => $errors->has('new_password_confirmation'),
        ])

        <hr>

        <button type="submit" class="btn btn-warning">
            Update Password
        </button>

    </form>--}}

@endsection
