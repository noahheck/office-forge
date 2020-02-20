@extends("layouts.app")

@push('styles')
    @style('css/files.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Files\Show($fileType, $file))
])

@section('content')


    <h4 class="h5 text-muted pl-3">{!! $fileType->icon() !!} - {{ $fileType->name }}</h4>

    <div class="row file">

        <div class="col-12 col-md-4 col-xl-3 mb-3">

            <div class="card shadow">
                <div class="card-body">
                    <h3 class="h4">{{ $file->name }}</h3>

                    <hr>

                    <div class="text-center">
                        <a class="btn btn-primary" href="{{ route('files.edit', [$file]) }}">
                            <span class="fas fa-edit mr-2"></span>{{ __('app.edit') }} {{ $fileType->name }}</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-12 col-md-8 col-xl-9">

            <div class="card shadow">
                <div class="card-body">

                </div>
            </div>

        </div>

    </div>

    {{--<div class="row file">

        <div class="col-12 col-md-8 col-xl-8">
            <div class="card shadow">
                <div class="card-body">

                    <h1 class="h2">
                        <span class="fas fa-clipboard-list"></span> {{ $instance->fullName }}
                    </h1>

                    <p>
                        @if ($instance->completed)
                            <span class="project--completed-indicator">
                                <span class="fas fa-check-circle"></span> {{ __('process.completed') }}
                            </span>
                        @endif
                    </p>

                    <div class="card">
                        <div class="card-body">
                            <dl class="row project-details">
                                <dt class="col-4 col-sm-3 col-xl-2">{{ __('process.instance_owner') }}</dt>
                                <dd class="col-8 col-sm-9 col-xl-10">
                                    @if ($instance->owner_id)
                                        {!! $instance->owner->iconAndName(['mhw-25p']) !!}
                                    @endif
                                </dd>

                            </dl>
                        </div>
                    </div>

                    @if ($instance->process_details)
                        <div class="editor-content mt-3">
                            {!! App\safe_text_editor_content($instance->process_details) !!}
                        </div>
                    @endif

                    @if ($instance->details)
                        <hr>
                        <div class="editor-content mt-3">
                            {!! App\safe_text_editor_content($instance->details) !!}
                        </div>
                    @endif

                    <hr>






                    <div class="d-flex justify-content-between">
                        <h2 class="h4">
                            <span class="fas fa-clipboard-check mr-2"></span>{{ __('process.tasks') }}
                        </h2>
                        <a href="{{ route('processes.tasks.index', [$instance]) }}">
                            <span class="far fa-arrow-alt-circle-right"></span> {{ __('process.tasks') }}
                        </a>
                    </div>

                    @forelse ($instance->tasks as $task)

                        @if ($loop->first)
                            <ul class="list-group" id="processTasks">
                        @endif

                            <li class="list-group-item d-flex" data-id="{{ $task->id }}">

                                @php
                                    $__toggleCompletedRouteName = ($task->completed) ? 'processes.tasks.uncomplete' : 'processes.tasks.complete';
                                    $__toggleCompletedTitleText = ($task->completed) ? __('process.task_markIncomplete') : __('process.task_markCompleted');
                                @endphp

                                <div class="flex-grow-0">
                                    <form action="{{ route($__toggleCompletedRouteName, [$instance, $task]) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        @hiddenField([
                                            'name' => 'return',
                                            'value' => url()->current(),
                                        ])
                                        <button type="submit" class="btn btn-link p-0 pr-3 text-reset" title="{{ $__toggleCompletedTitleText }}">
                                            <span class="sr-only">{{ $__toggleCompletedTitleText }}</span>
                                            <span class="far fa{{ ($task->completed) ? '-check' : '' }}-square fa-lg"></span>
                                        </button>
                                    </form>

                                </div>

                                <div class="flex-grow-1">

                                    <a href="{{ route('processes.tasks.show', [$instance, $task]) }}">
                                        {{ $task->task_name }}
                                    </a>
                                    @if ($task->details)
                                        <span class="text-muted fas fa-align-left"></span>
                                    @endif

                                    <br>

                                    <span class="text-muted"><span class="fas fa-tasks"></span> {{ $numActions = $task->numberOfTotalActions() }} {{ __('process.action' . (($numActions == 1) ? '' : 's')) }} @if($numActions > 0) ({{ $task->numberOfCompletedActions() }} {{ __('process.action_completed') }}) @endif</span>

                                </div>
                            </li>

                        @if ($loop->last)
                            </ul>
                        @endif

                    @empty


                    @endforelse

                </div>

            </div>
        </div>

        <div class="col-12 col-md-4 col-xl-4 mt-3 mt-md-0 pl-md-0">
            <div class="card shadow">

                <div class="card-body">
                    <p class="text-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('processes.edit', [$instance]) }}">
                            <span class="fas fa-edit"></span> {{ __('process.instance_editInstance') }}
                        </a>
                    </p>


                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>{{ __('process.instance_owner') }}</strong>
                            <br>
                            @if ($instance->owner_id)
                                {!! $instance->owner->iconAndName(['mhw-25p']) !!}
                            @endif
                        </li>
                        <li class="list-group-item">
                            <strong>Opened</strong>
                            <br>
                            {{ \App\format_datetime($instance->created_at) }}
                        </li>
                        <li class="list-group-item">
                            <strong>Opened By</strong>
                            <br>
                            {!! $instance->createdBy->iconAndName(['mhw-25p']) !!}
                        </li>
                    </ul>

                </div>

            </div>
        </div>

    </div>--}}
@endsection