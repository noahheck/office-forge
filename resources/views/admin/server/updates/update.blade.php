@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
    @style('css/admin.server.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Admin\Server\Update\Update),
])

@section('content')

    <div class="row justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container update-details">

            <h1>
                {!! \App\icon\updates(['mr-2']) !!}{{ __('admin.server_update') }}
            </h1>

            <p class="text-muted">{{ __('admin.server_update_shortDescription') }}</p>

            <div class="card document">
                <div class="card-body">

                <dl>
                    <dt>{{ __('admin.server_update_date') }}</dt>
                    <dd>{{ \App\format_date($update->created_at) }}</dd>

                    <dt>{{ __('admin.server_update_successful') }}</dt>
                    <dd>
                        @if ($update->successful)
                            {!! \App\icon\circleCheck(['text-success']) !!}
                        @else
                            {!! \App\icon\warning(['text-danger']) !!}
                        @endif
                    </dd>

                    <dt>{{ __('admin.server_update_startTime') }}</dt>
                    <dd>{{ \App\format_datetime($update->created_at) }}</dd>

                    <dt>{{ __('admin.server_update_endTime') }}</dt>
                    <dd>{{ \App\format_datetime($update->updated_at) }}</dd>

                    <dt>{{ __('admin.server_update_log') }}</dt>
                    <dd class="output-log">
                        {!! nl2br(e($update->output)) !!}
                    </dd>

                </dl>

                </div>
            </div>

        </div>

    </div>



@endsection
