@php
$__context = $context ?? false;
@endphp
<div class="activity @if($activity->isDueToday()) due-today @elseif($activity->isOverdue()) overdue @endif">

    <div class="d-flex">

        <span class="flex-grow-0 pr-2">
            <span class="far fa-{{ $activity->completed ? 'check-' : '' }}square mr-1"></span>
        </span>
        <strong class="activity-name flex-grow-1">
            @if ($__process_name = $activity->process_name)
                <span class="fas fa-clipboard-list mr-2"></span>{{ $__process_name }} -
            @endif
            {{ $activity->name }}
        </strong>

    </div>

    <div class="activity-details d-flex">
        <span class="flex-grow-1">
            @if ($__context !== 'file' && $__file = $activity->file)
                {!! $__file->icon(['mhw-25p']) !!} {{ $__file->name }}
                <br>
            @endif
            <span class="text-muted mr-2">#{{ $activity->id }}</span>
            @if ($activity->private)
                <span class="fas fa-user-shield detail text-muted" title="{{ __('activity.thisActivityPrivateVisibility') }}"></span>
            @endif
            @if ($activity->due_date)
                <span class="detail" title="{{ __('activity.dueDate') }}: {{ $__formattedDueDate = \App\format_date($activity->due_date) }}">
                    <span class="due-date"><span class="far fa-calendar-alt mr-1"></span>{{ $__formattedDueDate }}</span>
                </span>
            @endif
            @if ($activity->tasks->count() > 0)
                <span class="detail" title="{{ __('activity.countOfTotalTasksCompleted', ['completed' => $activity->numberOfCompletedTasks(), 'total' => $activity->numberOfTotalTasks()]) }}">
                    <span class="fas fa-tasks mr-1"></span>{{ $activity->numberOfCompletedTasks() }}/{{ $activity->numberOfTotalTasks() }}
                </span>
            @endif
        </span>
        @if ($__owner = $activity->owner)
                <span class="flex-grow-0 text-right">
                {!! $__owner->iconAndName(['mhw-25p']) !!}
            </span>
        @endif
    </div>

</div>
