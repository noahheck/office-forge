@php
$__context = $context ?? false;
@endphp
<div class="activity--list-item @if($activity->completed) completed @elseif($activity->isDueToday()) due-today @elseif($activity->isOverdue()) overdue @endif">

    <div class="icon-container">
        <span class="icon">
            @if ($activity->process_id)
                {!! \App\icon\processes(['fa-fw']) !!}
            @else
                {!! \App\icon\activities(['fa-fw']) !!}
            @endif
        </span>
    </div>

    <div class="details-container">
        <div class="activity--name">{{ $activity->getFullName() }}</div>
        <div class="details">
            <div class="activity-details">
                @if ($activity->due_date)
                    <div class="due-date">{{ \App\format_date($activity->due_date) }}</div>
                @endif
                @if ($__context !== 'file' && $__file = $activity->file)
                    <div>{!! $__file->icon(['mr-2', 'mhw-25p']) !!}{{ $__file->name }}</div>
                @endif
            </div>
            <div class="owner">
                <span>{!! $activity->owner->icon(['mr-2', 'mhw-25p']) !!}{{ $activity->owner->name }}</span>
            </div>
        </div>
    </div>

    {{--<div class="d-flex">

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
    </div>--}}

</div>
