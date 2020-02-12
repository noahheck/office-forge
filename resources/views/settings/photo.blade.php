@extends("layouts.settings")

@push('scripts')
    @script('js/page.settings.photo.js')
@endpush

@push('styles')
<style>

    .upload-preview {
        max-width: 200px;
        max-height: 200px;
    }

    .in-preview {
        opacity: .8;
    }

</style>
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar())
                    ->addLink(new \App\Navigation\Link\Settings\MySettings)
                    ->setCurrentLocation(__('settings.photo')),
])

@section('my-settings-content')

    <h2>{{ __('settings.photo_uploadProfilePhoto') }}</h2>

    <form action="{{ route('my-settings.photo.update') }}" method="POST" enctype="multipart/form-data" class="bold-labels">
        @csrf

        <div class="d-flex justify-content-center mb-3">
            {!! Auth::user()->thumbnail(['upload-preview', 'rounded']) !!}
        </div>

        @errors('new_profile_photo')

        <div class="custom-file">
            <input type="file" class="custom-file-input" id="new_profile_photo" name="new_profile_photo" required>
            <label class="custom-file-label" for="new_profile_photo">{{ __('settings.photo_selectPhoto') }}</label>
        </div>

        <hr>

        <button type="submit" class="btn btn-primary">
            {{ __('settings.photo_uploadPhoto') }}
        </button>

    </form>

@endsection
