@extends('layouts.app')

@push('styles')
    @style('css/home.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Home),
])


@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-lg-8">

            <div class="shadow card home--panel activities-panel">
                <div class="card-header d-flex">
                    <h4 class="mb-0 flex-grow-1"><span class="fas fa-project-diagram"></span> {{ __('app.activities') }}</h4>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary border-0 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="fas fa-plus-circle"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">

                            <a class="dropdown-item" href="{{ route("activities.create") }}">{{ __('activity.newActivity') }}</a>
                            @foreach ($processOptions as $__process)
                                @if ($loop->first)
                                    <div class="dropdown-divider"></div>
                                    <span class="dropdown-header"><span class="fa-fw fas fa-clipboard-list"></span> {{ __('app.processes') }}</span>
                                @endif
                                <a class="dropdown-item" href="{{ route('activities.create', ['process_id' => $__process->id]) }}">
                                    {{ $__process->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @forelse ($activities as $activity)

                        @if($loop->first)
                            <div class="list-group activities">
                        @endif

                            <a class="list-group-item list-group-item-action" href="{{ route("activities.show", [$activity]) }}">

                                @include("_component._activity")

                            </a>

                        @if($loop->last)
                            </div>
                        @endif
                    @empty

                    @endforelse
                </div>
            </div>

        </div>

    </div>
@endsection
