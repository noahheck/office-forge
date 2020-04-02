@extends("layouts.app")

@push('styles')
    @style('css/activities.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Activities\Index),
])

@section('content')
    <h1>
        <span class="fas fa-project-diagram"></span> {{ __('app.activities') }}
    </h1>

    <div class="card shadow">
        <div class="card-body">

                <div class="text-right">
                    <a href="{{ route('activities.create') }}" class="btn btn-primary">
                        <span class="fas fa-plus-circle"></span> {{ __('activity.newActivity') }}
                    </a>
                </div>
                <hr>

            @forelse($activities as $activity)

                @if($loop->first)

                    <div class="table-responsive">
                        <table id="projects" class="projects table table-striped table-bordered dt-table">
                            <thead>
                                <tr>
                                    <th class="w-75p">{{ __('activity.dueDate') }}</th>
                                    <th class="w-50p">&nbsp;</th>
                                    <th>{{ __('activity.name') }}</th>
                                    <th>{{ __('activity.owner') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                @endif

                <tr>
                    <td>
                        {{ App\format_date($activity->due_date) }}
                    </td>
                    <td data-sort="{{ ($activity->completed) ? '1' : '0' }}" class="text-center">
                        <span class="{{ ($activity->completed) ? "fas fa-check-square" : 'far fa-square' }}"></span>
                    </td>
                    <td>
                        <a href="{{ route('activities.show', [$activity]) }}">
                            {{ $activity->name }}
                        </a>
                    </td>
                    <td>
                        @if ($activity->owner_id)
                            {!! $activity->owner->iconAndName() !!}
                        @endif
                    </td>
                </tr>

                @if($loop->last)
                            </tbody>
                        </table>
                    </div>
                @endif

            @empty

                <p>No activities</p>

            @endforelse

        </div>
    </div>
@endsection
