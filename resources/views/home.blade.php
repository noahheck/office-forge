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
                    <a class="btn btn-sm btn-outline-secondary flex-grow-0 border-0" href="{{ route("activities.create") }}">
                        <span class="fas fa-plus-circle"></span>
                    </a>
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
