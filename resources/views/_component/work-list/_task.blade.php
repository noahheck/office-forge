@php
$__context = $context ?? false;
@endphp
<div class="task--list-item work-list--list-item @if($task->completed) completed @elseif($task->isDueToday()) due-today @elseif($task->isOverdue()) overdue @endif">
    <div class="icon-container">
        <span class="icon">
            {!! \App\icon\uncheckedBox(['fa-fw']) !!}
        </span>
    </div>
    <div class="details-container">
        <div class="form-doc--name">{{ $task->title }}</div>
        <div class="details">
            <div class="task-details">
                <div>
                    <small>
                        @if ($activity->due_date)
                            <span class="due-date mr-2">{!! \App\icon\calendar(['mr-1']) !!}{{ \App\format_date($task->due_date) }}</span>
                        @endif
                        {{--@if ($task->isSubmitted())
                            {{ \App\format_datetime($formDoc->submitted_at) }}
                        @else
                            <strong>{{ __('formDoc.started') }}:</strong> {{ \App\format_datetime($formDoc->created_at) }}
                        @endif
                        @if ($__context !== 'file' && $__file = $formDoc->file)
                            {!! $__file->icon(['ml-2', 'mr-2', 'mhw-25p']) !!}{{ $__file->name }}
                        @endif--}}
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
