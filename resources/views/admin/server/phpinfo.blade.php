@extends("layouts.admin")

@push('styles')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Admin\Server\PhpInfo),
])

@section('content')
    <h1>
        {!! \App\icon\php(['mr-2']) !!}{{ __('admin.server_php_phpinfo') }}
    </h1>

    <hr>

    <div class="row justify-content-center">
        <div class="col-12 col-md-10">

            <div class="card">
                <div class="card-body">

                    <iframe srcdoc="{{ $phpInfo }}" style="height: 500px; width: 100%"></iframe>

                </div>

            </div>

        </div>

    </div>

    {{--<div class="row">
        <div class="col-12 col-md-6">
            <div class="card shadow server-details-card">
                <div class="card-header">
                    <h4 class="mb-0">{!! \App\icon\server(['mr-2']) !!}{{ __('admin.server_operatingSystem') }}</h4>
                </div>
                <div class="card-body">
                    @forelse ($osDetails as $key => $value)
                        @if ($loop->first)
                            <dl>
                        @endif
                            <dt>{{ $key }}</dt>
                            <dd>{{ $value }}</dd>
                        @if ($loop->last)
                            </dl>
                        @endif

                    @empty
                        <p><em>{{ __('admin.server_noOSDetailsAvailable') }}</em></p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="card shadow server-details-card">
                <div class="card-header d-flex">
                    <h4 class="mb-0 flex-grow-1">{!! \App\icon\php(['mr-2']) !!}{{ __('admin.server_php') }}</h4>
                    <a href="#" class="flex-grow-0">{{ __('admin.server_php_viewPhpInfo') }}{!! \App\icon\go(['ml-2']) !!}</a>
                </div>
                <div class="card-body">
                    @forelse ($phpDetails as $key => $value)
                        @if ($loop->first)
                            <dl>
                        @endif
                            <dt>{{ __('admin.server_php_' . $key) }}</dt>
                            <dd>{{ (is_array($value)) ? implode(',', $value) : $value }}</dd>
                        @if ($loop->last)
                            </dl>
                        @endif

                    @empty
                        <p><em>{{ __('admin.server_noPHPDetailsAvailable') }}</em></p>
                    @endforelse
                </div>

            </div>

        </div>


    </div>--}}



@endsection
