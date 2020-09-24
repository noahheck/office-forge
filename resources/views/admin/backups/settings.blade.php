@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Admin\Backups\Settings),
])

@section('content')

    <div class="row justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h1>
                {!! \App\icon\backups(['mr-2']) !!}{{ __('admin.backups_settings') }}
            </h1>

            <p class="text-muted">{{ __('admin.backups_settings_shortDescription') }}</p>

            <div class="card document">
                <div class="card-body">

                    <form action="{{ route('admin.backups.save-settings') }}" method="POST" class="bold-labels">

                        @csrf


                        @errors('time', 'storageTime')

                        @selectField([
                            'name' => 'time',
                            'label' => __('admin.backups_time'),
                            'details' => __('admin.backups_timeDescription'),
                            'value' => old('time', $time),
                            'options' => array_combine(\App\Backups::timeOptions(), \App\Backups::timeOptions()),
                            'placeholder' => '',
                            'required' => true,
                            'autofocus' => true,
                            'error' => $errors->has('time'),
                            'readonly' => false,
                        ])

                        @selectField([
                            'name' => 'storageTime',
                            'label' => __('admin.backups_storageTime'),
                            'details' => __('admin.backups_storageTimeDescription'),
                            'value' => old('storageTime', $storageTime),
                            'options' => \App\Backups::storageTimeOptions(),
                            'placeholder' => '',
                            'required' => true,
                            'autofocus' => false,
                            'error' => $errors->has('storageTime'),
                            'readonly' => false,
                        ])

                        <hr>

                        <button type="submit" class="btn btn-primary">
                            {{ __('app.save') }}
                        </button>

                        <a class="btn btn-secondary" href="{{ url()->previous(route('admin.backups')) }}">
                            {{ __('app.cancel') }}
                        </a>

                    </form>

                </div>
            </div>

        </div>

    </div>



@endsection
