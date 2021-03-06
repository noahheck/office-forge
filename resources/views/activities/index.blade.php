@extends("layouts.app")

@push('styles')
    @style('css/activities.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Activities\Index),
])

@section('content')

    <div class="float-right">
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="newActivityButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {!! \App\icon\circlePlus(['mr-1']) !!}{{ __('activity.newActivity') }}
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="newActivityButton">
                <a class="dropdown-item" href="{{ route("activities.create") }}">{{ __('activity.newActivity') }}</a>

                @foreach ($processes as $__process)
                    @if ($loop->first)
                        <div class="dropdown-divider"></div>
                        <span class="dropdown-header">{!! \App\icon\processes(['fa-fw']) !!} {{ __('app.processes') }}</span>
                    @endif

                    <a class="dropdown-item" href="{{ route('activities.create', ['process_id' => $__process->id]) }}">
                        {{ $__process->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <h1>
        {!! \App\icon\activities(['mr-2']) !!}{{ __('app.activities') }}
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
                                    <th class="w-100p">{{ __('activity.owner') }}</th>
                                    <th class="w-100p">{{ __('app.file') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                @endif

                <tr>
                    <td data-sort="{{ $activity->due_date }}">
                        {{ App\format_date($activity->due_date) }}
                    </td>
                    <td data-sort="{{ ($activity->completed) ? '1' : '0' }}" class="text-center">
                        @if ($activity->completed)
                            {!! \App\icon\checkedBox() !!}
                        @else
                            {!! \App\icon\uncheckedBox() !!}
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('activities.show', [$activity]) }}">
                            {{ $activity->getFullName() }}</a>

                        <small class="text-muted">
                            #{{ $activity->id }}
                            @if ($activity->private)
                                <span class="fas fa-user-shield ml-1"></span>
                            @endif
                        </small>
                    </td>
                    <td>
                        @if ($activity->owner_id)
                            {!! $activity->owner->iconAndName() !!}
                        @endif
                    </td>
                    <td>
                        @if ($activity->file_id && $__file = $activity->file)
                            {!! $__file->icon() !!}
                            <a href="{{ route('files.show', [$__file->id]) }}">{{ $__file->name }}</a>
                        @endif
                    </td>
                </tr>

                @if($loop->last)
                            </tbody>
                        </table>
                    </div>
                @endif

            @empty

                <div class="empty-resource border p-3">
                    {!! \App\icon\activities(['empty-resource-icon']) !!}
                    <p>{{ __('activity.description') }}</p>
                </div>

            @endforelse

        </div>
    </div>
@endsection
