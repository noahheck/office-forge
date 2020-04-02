@extends("layouts.app")

@push('styles')
    @style('css/activities.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Activities\Index),
])

@section('content')

    <div class="float-right">
        <a href="{{ route('activities.create') }}" class="btn btn-primary">
            <span class="fas fa-plus-circle"></span> {{ __('activity.newActivity') }}
        </a>
    </div>

    <h1>
        <span class="fas fa-project-diagram"></span> {{ __('app.activities') }}
    </h1>


    <div class="card shadow">
        <div class="card-body">

            <form action="{{ route("activities.index") }}" method="GET" class="bold-labels">

                <div class="row">

                    <div class="col-6 col-sm-6">

                        @selectField([
                            'name' => 'show',
                            'label' => 'Show:',
                            'details' => '',
                            'value' => $showFilter,
                            'options' => [
                                'open' => 'Open Activities',
                                'all'  => 'All Activities',
                            ],
                            'placeholder' => '',
                            'required' => true,
                            'autofocus' => false,
                            'error' => false,
                            'readonly' => false,
                        ])

                    </div>

                    <div class="col-3 d-flex align-items-center">
                        <button type="submit" class="btn btn-primary">
                            <span class="far fa-eye"></span> View
                        </button>
                    </div>

                </div>

            </form>



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
                    <td data-sort="{{ $activity->due_date }}">
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
