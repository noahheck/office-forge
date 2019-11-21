@extends("layouts.settings")

@section('my-settings-content')

    <h2>{{ __('settings.photo_uploadProfilePhoto') }}</h2>

    <form action="{{ route('my-settings.photo.update') }}" method="POST" enctype="multipart/form-data" class="bold-labels">
        @csrf

        <div class="custom-file">
            <input type="file" class="custom-file-input" id="new_profile_photo" name="new_profile_photo">
            <label class="custom-file-label" for="new_profile_photo">{{ __('settings.photo_selectPhoto') }}</label>
        </div>

        <hr>

        <button type="submit" class="btn btn-primary">
            {{ __('settings.photo_uploadPhoto') }}
        </button>

    </form>

@endsection
