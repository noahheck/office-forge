@php
$__context = $context ?? false;
@endphp
<div class="activity--list-item @if($activity->completed) completed @elseif($activity->isDueToday()) due-today @elseif($activity->isOverdue()) overdue @endif">

    <div class="icon-container">
        <span class="icon">
            {!! $activity->icon(['fa-fw']) !!}
        </span>
    </div>

    <div class="details-container">
        <div class="activity--name">{{ $activity->getFullName() }}</div>
        <div class="details">
            <div class="activity-details">
                @if ($__context !== 'file' && $__file = $activity->file)
                    <div>{!! $__file->icon(['mr-2', 'mhw-25p']) !!}{{ $__file->name }}</div>
                @endif
                @if ($activity->due_date)
                    <span class="due-date">{!! \App\icon\calendar(['mr-1']) !!}{{ \App\format_date($activity->due_date) }}</span>
                @endif
                @if ($activity->private || $activity->tasks->count() > 0 || $activity->formDocs->count() > 0)

                    @php
                        $__earliestOpenTask = optional($activity->earliestOpenTaskWithDueDate());
                    @endphp
                    <div class="detail @if($__earliestOpenTask->isOverdue()) overdue @elseif($__earliestOpenTask->isDueToday()) due-today @endif">

                        @if ($activity->private)
                            <span class="mr-2" title="{{ __('activity.thisActivityPrivateVisibility') }}">
                                {!! \App\icon\isPrivate() !!}
                            </span>
                        @endif

                        @if ($activity->tasks->count() > 0)
                            <span class="mr-2" title="{{ __('activity.countOfTotalTasksCompleted', ['completed' => $activity->numberOfCompletedTasks(), 'total' => $activity->numberOfTotalTasks()]) }}">
                                {!! \App\icon\tasks(['mr-1']) !!}{{ $activity->numberOfCompletedTasks() }}/{{ $activity->numberOfTotalTasks() }}
                                @if ($__earliestOpenTask->due_date)
                                    <small class="due-date">{!! \App\icon\calendarCheck(['mr-1']) !!}{{ \App\format_date($__earliestOpenTask->due_date) }}</small>
                                @endif
                            </span>
                        @endif

                        @if ($activity->formDocs->count() > 0)
                            <span class="mr-2" title="{{ __('activity.countOfTotalFormDocsCompleted', ['completed' => $activity->numberOfCompletedFormDocs(), 'total' => $activity->numberOfTotalFormDocs()]) }}">
                                {!! \App\icon\formDocs(['mr-1']) !!}{{ $activity->numberOfCompletedFormDocs() }}/{{ $activity->numberOfTotalFormDocs() }}
                            </span>
                        @endif

                    </div>
                @endif
            </div>
            <div class="owner">
                <span>{!! $activity->owner->icon(['mr-2', 'mhw-25p']) !!}{{ $activity->owner->name }}</span>
            </div>
        </div>
    </div>

</div>
