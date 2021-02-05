@extends("layouts.app")

@section('title'){{ $activity->getFullName() }}@endsection

@push('styles')
    @style('css/activities.css')
    @style('css/document.css')
    @style('css/fileStore.css')
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

            @can('update', $activity)

                <div class="card shadow document drag-drop-file-upload-target" data-controller="drag-drop-file-upload" data-target="drag-drop-file-upload.container">

                    <form action="{{ route('resource-files.upload') }}" class="drag-drop-file-upload-form" method="POST" enctype="multipart/form-data" data-target="drag-drop-file-upload.form">

                        @csrf

                        @hiddenField([
                            'name' => 'return',
                            'value' => url()->current(),
                        ])

                        @hiddenField([
                            'name' => 'resource_type',
                            'value' => get_class($activity),
                        ])

                        @hiddenField([
                            'name' => 'resource_id',
                            'value' => $activity->id,
                        ])

                        <input type="file" id="resourceFiles_input" name="files[]" class="d-none show-for-sr" multiple data-target="drag-drop-file-upload.input">

                        <label for="resourceFiles_input">
                            {!! nl2br(e(__('fileStore.dropFilesToTarget', ['target' => $activity->getFullName()]))) !!}
                        </label>

                        <span class="files-are-uploading-indicator">
                            {!! \App\icon\spinner(['fa-spin']) !!}
                        </span>

                    </form>

            @else

                <div class="card shadow document">

            @endcan


                <div class="card-body">

                    <div class="border-bottom mb-3">

                        <h1 class="h3">
                            {!!$activity->icon(['mr-2']) !!}{{ $activity->getFullName() }}
                            <small class="text-muted">#{{ $activity->id }}</small>
                        </h1>

                        @if ($file ?? false)
                            <div class="d-flex align-items-center mb-2 pl-4">
                                {!! $file->icon(['mhw-35p', 'mr-2']) !!}
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
                                                {!! \App\icon\circleCheck(['mr-1']) !!}{{ __('activity.completed') }}
                                            </span>
                                        @else
                                            <form action="{{ route('activities.complete', [$activity]) }}" method="POST" class="no-print">
                                                @csrf
                                                <button type="submit" class="btn btn-light">
                                                    {!! \App\icon\uncheckedBox(['fa-lg']) !!}
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
                                                    {!! \App\icon\undo() !!}
                                                    {{ __('activity.reopen') }}
                                                </button>
                                            </form>
                                        @else
                                            <a class="btn btn-primary btn-sm no-print" href="{{ route('activities.edit', [$activity]) }}">
                                                {!! \App\icon\edit(['mr-1']) !!}{{ __('activity.editActivity') }}
                                            </a>
                                        @endif

                                    </div>

                                @else
                                    <div class="flex-grow-1">
                                        @if ($activity->completed)
                                            <span class="project--completed-indicator">
                                                {!! \App\icon\circleCheck() !!} {{ __('activity.completed') }}
                                            </span>
                                        @else
                                            &nbsp;
                                        @endif
                                    </div>
                                    <div>
                                        @unless($activity->completed)
                                            <button class="btn btn-secondary disabled btn-sm no-print" data-trigger="hover focus" data-toggle="popover" data-content="{{ __('activity.onlyActivityOwnerCanEdit') }}">
                                                {!! \App\icon\edit(['mr-1']) !!}{{ __('activity.editActivity') }}
                                            </button>
                                            <span class="sr-only">{{ __('activity.onlyActivityOwnerCanEdit') }}</span>
                                        @endunless
                                    </div>
                                @endcan
                            </div>

                            <hr class="hide-if-overdue">

                            @if ($activity->private)
                                <p class="text-muted">
                                    {!! \App\icon\isPrivate() !!}
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
                                        {{ App\format_date($activity->completed_at) }}&nbsp;
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
                            @endif

                            @unless ($activity->process_details || $activity->details)
                                <p class="text-muted">
                                    <em>{{ __('activity.noDetails') }}</em>
                                </p>
                            @endunless


                            <h4 class="separator">
                                <span>
                                    {!! \App\icon\mediaFile(['mr-1']) !!}{{ __('activity.mediaFiles') }}
                                </span>
                            </h4>

                            @if ($activity->resourceFiles->count() > 0)
                                @include("_resource-files.cards", [
                                    'resourceFiles' => $activity->resourceFiles,
                                ])
                            @endif

                            @can('update', $activity)
                                <label for="resourceFiles_input" class="btn btn-sm btn-primary">
                                    {!! \App\icon\mediaFileUpload(['mr-1']) !!}{{ __('activity.uploadFile') }}
                                </label>
                            @endcan




                            @if ($activity->formDocs->count() > 0)
                                <h4 class="separator">
                                    <span>{!! \App\icon\formDocs(['mr-2']) !!}{{ __('app.formDocs') }}
                                        <small class="text-muted" title="{{ __('activity.countOfTotalFormDocsCompleted', ['completed' => $activity->numberOfCompletedFormDocs(), 'total' => $activity->numberOfTotalFormDocs()]) }}">
                                            ({{ $activity->numberOfCompletedFormDocs() }}<span class="p-half">/</span>{{ $activity->numberOfTotalFormDocs() }})
                                        </small>
                                    </span>
                                </h4>

                                <div class="list-group activities">

                                    @foreach ($activity->formDocs as $formDoc)
                                        <a class="list-group-item list-group-item-action" href="{{ route("form-docs.show", [$formDoc]) }}">

                                            @include("_component._form-doc")

                                        </a>
                                    @endforeach

                                </div>
                            @endif


                            <h4 class="separator">
                                <span>{!! \App\icon\tasks(['mr-1']) !!}{{ __('activity.tasks') }}
                                    @if ($activity->tasks->count() > 0)
                                        <small class="text-muted" title="{{ __('activity.countOfTotalTasksCompleted', ['completed' => $activity->numberOfCompletedTasks(), 'total' => $activity->numberOfTotalTasks()]) }}">
                                            ({{ $activity->numberOfCompletedTasks() }}<span class="p-half">/</span>{{ $activity->numberOfTotalTasks() }})
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
