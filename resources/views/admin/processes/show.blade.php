@extends("layouts.admin")

@push('scripts')
    @script('js/page.admin.processes.show.js')
@endpush

@push('meta')
    @meta('processId', $process->id)
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Processes\Show($process),
])

@section('content')


    <div class="row justify-content-center">

        <div class="col-12 col-md-8 order-2 order-md-1">

            <div class="card">

                <div class="card-body">

                    <h1 class="h3">
                        {!! \App\icon\processes(['mr-2']) !!}{{ $process->name }}
                    </h1>

                    <hr>

                    @if ($process->details)

                        <div class="editor-content">
                            {!! App\safe_text_editor_content($process->details) !!}
                        </div>

                        <hr>

                    @endif

                    <div class="d-flex justify-content-between">
                        <h2 class="h4">
                            {!! \App\icon\tasks(['mr-2']) !!}{{ __('admin.tasks') }}
                        </h2>
                        <a href="{{ route('admin.processes.tasks.index', [$process]) }}">
                            {!! \App\icon\go(['mr-1']) !!}{{ __('admin.tasks') }}
                        </a>
                    </div>

                    @forelse ([] as $a)//$process->tasks as $task)

                        @if ($loop->first)
                            <ul class="list-group" id="processTasks">
                        @endif

                        <li class="list-group-item d-flex" data-id="{{ $task->id }}">
                            <div class="flex-grow-1">

                                {!! \App\icon\uncheckedBox() !!}
                                <a href="{{ route('admin.processes.tasks.show', [$process, $task]) }}">
                                    {{ $task->name }}
                                </a>
                                @if ($task->details)
                                    {!! \App\icon\text(['text-muted']) !!}
                                @endif

                            </div>
                            <div class="sort-handle">
                                {!! \App\icon\verticalSort() !!}
                            </div>
                        </li>

                        @if ($loop->last)
                            </ul>
                        @endif

                    @empty

                        <div class="text-center border p-4 empty-resource">

                            {!! \App\icon\tasks(['empty-resource-icon']) !!}

                            <p>{{ __('admin.task_description') }}</p>

                        </div>

                    @endforelse

                    <div class="text-right mt-3">
                        <a href="{{ route('admin.processes.tasks.create', [$process]) }}" class="btn btn-sm btn-primary">
                            {!! \App\icon\circlePlus(['mr-1']) !!}{{ __('admin.addTask') }}
                        </a>
                    </div>

                </div>

            </div>

        </div>

        <div class="col-12 col-md-4 order-1 order-md-2 pl-md-0">

            <div class="card mb-3 mb-md-auto">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <span>
                            @if ($process->active)
                                {!! \App\icon\checkedBox(['mr-2']) !!}{{ __('process.active') }}
                            @else
                                {!! \App\icon\uncheckedBox(['mr-2']) !!}{{ __('process.active') }}
                            @endif
                        </span>

                        <a href="{{ route('admin.processes.edit', [$process]) }}" class="btn btn-sm btn-primary">
                            {!! \App\icon\edit(['mr-1']) !!}{{ __('admin.editProcess') }}
                        </a>

                    </div>

                    <hr>

                    @if ($__fileType = $process->fileType)

                        <strong>{!! \App\icon\files(['mr-2']) !!}{{ __('process.fileType') }}</strong>

                        <br>

                        {!! $__fileType->icon(['ml-3']) !!}
                        <a href="{{ route('admin.file-types.show', [$__fileType]) }}">
                            {{ $__fileType->name }}
                        </a>

                        <hr>
                    @endif


                    @forelse ($process->creatingTeams as $team)

                        @if ($loop->first)
                            <strong>{!! \App\icon\teams(['mr-2']) !!}{{ __('process.creatingTeams') }}</strong>

                            <br>

                            <ul class="list-group">
                        @endif

                            <li class="list-group-item p-2">
                                {!! $team->icon() !!} {{ $team->name }}
                            </li>

                        @if ($loop->last)
                            </ul>
                        @endif

                    @empty

                        {{ __('process.teamsUnrestrictedDescription') }}

                    @endforelse

                </div>
            </div>

        </div>

    </div>
@endsection
