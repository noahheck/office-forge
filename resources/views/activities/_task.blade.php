{{-- --}}
<div class="list-group-item task p-0 @if(!$activity->completed && $task->isDueToday()) due-today @elseif(!$activity->completed && $task->isOverdue()) overdue @endif" data-id="{{ $task->id }}">

    <div class="d-flex p-1 align-items-center task-header">

        <div class="pr-sm-1">
            @if (!$task->completed)
                @can('update', $task)
                    <form action="{{ route('activities.tasks.complete', [$activity, $task]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-light" data-toggle="tooltip" data-delay='{"show":300}' data-placement="bottom" title="{{ __('activity.completeTask') }}">
                            {!! \App\icon\uncheckedBox(['fa-lg']) !!}
                            <span class="sr-only">{{ __('activity.completeTask') }}</span>
                        </button>
                    </form>
                @endcan
            @else
                {!! \App\icon\checkedBox() !!}
            @endif
        </div>

        <a class="flex-grow-1 pl-2" data-toggle="collapse" data-target="#task_content_{{ $task->id }}" href="{{ route('activities.tasks.show', [$activity, $task]) }}">

            <span class="task-title">{{ $task->title }}</span>

            <div class="task-attributes">
                @if ($task->assigned_to)
                    {!! $task->assignedTo->icon() !!}
                @endif
                @if ($task->details)
                    {!! \App\icon\text() !!}
                @endif
                @if ($task->due_date)
                    <span class="project--task--due-date">{!! \App\icon\calendar(['calendar-icon', 'mr-1']) !!}{{ App\format_date($task->due_date) }}</span>
                @endif
                @if ($task->completed)
                    <span title="{{ __('activity.completed') }} {{ \App\format_datetime($task->completed_at) }}">
                        {!! \App\icon\calendarCheck(['mr-1']) !!}{{ \App\format_datetime($task->completed_at, 'm/d/Y') }}
                    </span>
                @endif
            </div>

        </a>

        @if (!$task->completed)
            @can('update', $activity)
                <div class="pr-3 pl-2">
                    {!! \App\icon\verticalSort(['sort-handle']) !!}
                </div>
            @endcan
        @endif

    </div>

    <div class="collapse" id="task_content_{{ $task->id }}">

        <div class="p-1 pt-2 mt-1 ml-5 border-top pb-3">

            <dl class="row">
                <dt class="col-12 col-sm-3 col-xl-2 text-sm-right">{{ __('activity.taskAssigned') }}</dt>
                <dd class="col-12 col-sm-9 col-xl-10">
                    @if ($task->assigned_to)
                        {!! $task->assignedTo->iconAndName() !!}
                    @endif
                </dd>

                <dt class="col-12 col-sm-3 col-xl-2 text-sm-right">{{ __('activity.taskDueDate') }}</dt>
                <dd class="col-12 col-sm-9 col-xl-10 task--due-date due-date">
                    @if ($task->due_date)
                    {!! \App\icon\calendar(['mr-1']) !!}{{ App\format_date($task->due_date) }}
                    @endif
                    &nbsp;
                </dd>

                @if ($task->completed)
                    <dt class="col-12 col-sm-3 col-xl-2 text-sm-right">{{ __('activity.completed') }}</dt>
                    <dd class="col-12 col-sm-9 col-xl-10 task--due-date due-date">
                        {!! \App\icon\calendarCheck(['mr-1']) !!}{{ App\format_datetime($task->completed_at) }}
                    </dd>

                    <dt class="col-12 col-sm-3 col-xl-2 text-sm-right">{{ __('activity.completedBy') }}</dt>
                    <dd class="col-12 col-sm-9 col-xl-10 task--due-date due-date">
                        {!! $task->completedBy->iconAndName() !!}
                    </dd>
                @else
                    @can('update', $task)
                        <dt class="col-12 col-sm-3 col-xl-2 text-sm-right">&nbsp;</dt>
                        <dd class="col-12 col-sm-9 col-xl-10">
                            <a href="{{ route('activities.tasks.edit', [$activity, $task]) }}">
                                {!! \App\icon\edit(['mr-1']) !!}{{ __('app.edit') }}</a>
                        </dd>
                    @endcan
                @endif

            </dl>

            <hr>

            @if ($task->process_task_details)
                <div class="editor-content pr-2">
                    {!! \App\safe_text_editor_content($task->process_task_details) !!}
                </div>
            @endif

            @if ($task->details)
                <div class="editor-content pr-2">
                    {!! \App\safe_text_editor_content($task->details) !!}
                </div>
            @endif

            @unless($task->process_task_details || $task->details)
                <em>{{ __('activity.noDetails') }}</em>
            @endunless

            <hr class="no-print">

            <div class="d-flex no-print">

                <div class="flex-grow-1">
                    <a href="{{ route('activities.tasks.show', [$activity, $task]) }}" class="btn btn-link btn-sm">
                        {{ __('activity.viewTask') }}{!! \App\icon\go(['ml-1']) !!}
                    </a>
                </div>

                <div>

                    @if (!$task->completed)
                        @can('update', $task)
                            <a href="{{ route('activities.tasks.edit', [$activity, $task]) }}" class="btn btn-sm btn-primary">
                                {!! \App\icon\edit(['mr-1']) !!}{{ __('app.edit') }}</a>
                        @endcan
                    @endif

                    <button class="btn btn-sm btn-secondary" data-toggle="collapse" data-target="#task_content_{{ $task->id }}">
                        {{ __('app.close') }}
                    </button>

                </div>
            </div>

        </div>

    </div>

</div>
