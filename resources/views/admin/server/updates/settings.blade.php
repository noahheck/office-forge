@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Admin\Server\UpdateSettings),
])

@section('content')

    <div class="row justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h1>
                {!! \App\icon\server(['mr-2']) !!}{{ __('admin.server_updateSettings') }}
            </h1>

            <p class="text-muted">{{ __('admin.server_updateSettings_shortDescription') }}</p>

            <div class="card document">
                <div class="card-body">

                    <form action="{{ route('admin.server.updates.save-settings') }}" method="POST" class="bold-labels">
                        @csrf

                        @selectField([
                            'name' => 'schedule',
                            'label' => __('admin.server_updateSchedule'),
                            'details' => __('admin.server_updateScheduleDescription'),
                            'value' => old('schedule', $schedule),
                            'options' => \App\Server\Updates::scheduleOptions(),
                            'placeholder' => '',
                            'required' => true,
                            'autofocus' => true,
                            'error' => $errors->has('schedule'),
                            'readonly' => false,
                        ])

                        @selectField([
                            'name' => 'time',
                            'label' => __('admin.server_updateTime'),
                            'details' => __('admin.server_updateTimeDescription', ['timezone' => \App\timezone_name(Auth::user()->timezone)]),
                            'value' => old('time', $time),
                            'options' => array_combine(\App\Server\Updates::timeOptions(), \App\Server\Updates::timeOptions()),
                            'placeholder' => '',
                            'required' => true,
                            'autofocus' => true,
                            'error' => $errors->has('time'),
                            'readonly' => false,
                        ])

                        <hr>

                        <button type="submit" class="btn btn-primary">
                            {{ __('app.save') }}
                        </button>

                        <a class="btn btn-secondary" href="{{ url()->previous(route('admin.server')) }}">
                            {{ __('app.cancel') }}
                        </a>

                    </form>

                </div>
            </div>

        </div>

    </div>



@endsection
