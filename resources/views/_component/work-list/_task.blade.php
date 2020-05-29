@php
$__context = $context ?? false;
@endphp
<div class="task--list-item work-list--list-item @if($task->completed) completed @elseif($task->isDueToday()) due-today @elseif($task->isOverdue()) overdue @endif">
    <div class="icon-container">
        <span class="icon">
            @if ($task->completed)
                {!! \App\icon\checkedBox(['fa-fw']) !!}
            @else
                {!! \App\icon\uncheckedBox(['fa-fw']) !!}
            @endif
        </span>
    </div>
    <div class="details-container">
        <div class="form-doc--name">{{ $task->title }}</div>
        <div class="details">
            <div class="task-details">
                <div>
                    <small>
                        @if ($task->completed)
                            <span class="mr-2">{{ __('activity.taskCompleted') }}: {{ \App\format_datetime($task->completed_at) }}</span>
                        @elseif ($task->due_date)
                            <span class="due-date mr-2">{!! \App\icon\calendar(['mr-1']) !!}{{ \App\format_date($task->due_date) }}</span>
                        @endif
                        <span>
                            {!! $task->activity->icon(['mr-1']) !!}{{ $task->activity->name }}
                        </span>
                        @if ($__file = $task->activity->file)
                            <span>
                                {!! $__file->icon(['ml-2', 'mr-1', 'mhw-25p']) !!}{{ $__file->name }}
                            </span>
                        @endif
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
