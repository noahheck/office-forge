@extends("layouts.app")

@push('styles')
    @style('css/activities.css')
    @style('css/document.css')
@endpush

@push('scripts')
    @script('js/page.activities.show.js')
@endpush

@push('meta')
    @meta('activityId', $activity->id)
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Activities\Show($activity))
])

@section('content')

    <div class="row project justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">
            <div class="card shadow document">
                <div class="card-body">

                    <div class="border-bottom mb-3">

                        <h1 class="h3">
                            @if ($activity->process_id)
                                <span class="fas fa-clipboard-list"></span> {{ $activity->process_name }} - {{ $activity->name }}
                            @else
                                <span class="fas fa-project-diagram"></span> {{ $activity->name }}
                            @endif
                            <small class="text-muted">#{{ $activity->id }}</small>
                        </h1>

                        @if ($file ?? false)
                            <div class="d-flex align-items-center mb-2">
                                {!! $file->icon(['mhw-35p', 'mr-3', 'ml-2']) !!}
                                <h5 class="mb-0"><a href="{{ route("files.show", [$file]) }}">{{ $file->name }}</a></h5>
                            </div>
                        @endif

                    </div>
                    <div class="row">

                        <div class="col-12">

                            <div class="d-flex align-items-center">

                                @can('update', $activity)

                                    <div class="flex-grow-1">

                                        @if ($activity->completed)
                                            <span class="project--completed-indicator">
                                                <span class="fas fa-check-circle"></span> {{ __('activity.completed') }}
                                            </span>
                                        @else
                                            <form action="{{ route('activities.complete', [$activity]) }}" method="POST" class="no-print">
                                                @csrf
                                                <button type="submit" class="btn btn-light">
                                                    <span class="far fa-square fa-lg"></span>
                                                    {{ __('activity.complete') }}
                                                </button>
                                            </form>
                                        @endif

                                    </div>

                                    <div>

                                        @if ($activity->completed)
                                            <form action="{{ route('activities.uncomplete', [$activity]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-light btn-sm no-print">
                                                    <span class="fas fa-undo"></span>
                                                    {{ __('activity.reopen') }}
                                                </button>
                                            </form>
                                        @else
                                            <a class="btn btn-primary btn-sm no-print" href="{{ route('activities.edit', [$activity]) }}">
                                                <span class="fas fa-edit"></span> {{ __('activity.editActivity') }}
                                            </a>
                                        @endif

                                    </div>

                                @else
                                    <div class="flex-grow-1">
                                        @if ($activity->completed)
                                            <span class="project--completed-indicator">
                                                <span class="fas fa-check-circle"></span> {{ __('activity.completed') }}
                                            </span>
                                        @else
                                            &nbsp;
                                        @endif
                                    </div>
                                    <div>
                                        @unless($activity->completed)
                                            <button class="btn btn-secondary disabled btn-sm no-print" data-trigger="hover focus" data-toggle="popover" data-content="{{ __('activity.onlyActivityOwnerCanEdit') }}">
                                                <span class="fas fa-edit"></span> {{ __('activity.editActivity') }}
                                            </button>
                                            <span class="sr-only">{{ __('activity.onlyActivityOwnerCanEdit') }}</span>
                                        @endunless
                                    </div>
                                @endcan
                            </div>

                            <hr class="hide-if-overdue">

                            @if ($activity->private)
                                <p class="text-muted">
                                    <span class="fas fa-user-shield"></span>
                                    {{ __('activity.thisActivityPrivateVisibility') }}
                                </p>

                                <hr class="hide-if-overdue">
                            @endif

                            <dl class="row project-details {{ ($activity->isOverdue()) ? 'overdue' : '' }}">
                                <dt class="col-12 col-sm-3 col-xl-2 text-sm-right">{{ __('activity.owner') }}</dt>
                                <dd class="col-12 col-sm-9 col-xl-10">
                                    {!! $activity->owner->iconAndName() !!}
                                    <hr>
                                </dd>

                                <dt class="col-12 col-sm-3 col-xl-2 text-sm-right">{{ __('activity.dueDate') }}</dt>
                                <dd class="col-12 col-sm-9 col-xl-10 project--due-date">
                                    {{ App\format_date($activity->due_date) }}&nbsp;
                                    <hr>
                                </dd>

                                @if($activity->completed)
                                    <dt class="col-12 col-sm-3 col-xl-2 text-sm-right">{{ __('activity.completed') }}</dt>
                                    <dd class="col-12 col-sm-9 col-xl-10">
                                        {{ App\format_date($activity->completed_at) }}
                                        <hr>
                                    </dd>
                                @endif

                                <dt class="col-12 col-sm-3 col-xl-2 text-sm-right">
                                    <a href="{{ $participantRoute }}">{{ __('activity.participants') }}</a>
                                </dt>
                                <dd class="col-12 col-sm-9 col-xl-10">
                                    @forelse ($activity->participants as $participant)
                                        {!! $participant->user->icon() !!}
                                        <span class="sr-only">{{ $participant->user->name }}</span>
                                    @empty
                                        <em class="text-muted">{{ __('activity.noParticipants') }}</em>
                                    @endforelse
                                </dd>


                            </dl>

                            <hr class="hide-if-overdue">

                            @if ($activity->process_id && $activity->process_details)
                                <div class="editor-content">
                                    {!! App\safe_text_editor_content($activity->process_details) !!}
                                </div>

                                <hr>

                            @endif


                            @if ($activity->details)
                                <div class="editor-content">
                                    {!! App\safe_text_editor_content($activity->details) !!}
                                </div>
                            @else
                                <p class="text-muted">
                                    <em>{{ __('activity.noDetails') }}</em>
                                </p>
                            @endif




                            <h4 class="separator">
                                <span><span class="fas fa-tasks mr-1"></span>{{ __('activity.tasks') }}
                                    @if ($activity->tasks->count() > 0)
                                        <small class="text-muted" title="{{ __('activity.countOfTotalTasksCompleted', ['completed' => $activity->numberOfCompletedTasks(), 'total' => $activity->numberOfTotalTasks()]) }}">
                                            ({{ $activity->numberOfCompletedTasks() }}<span class="m-half">/</span>{{ $activity->numberOfTotalTasks() }})
                                        </small>
                                    @endif
                                </span>
                            </h4>

                            @include("activities._tasklist")

                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
