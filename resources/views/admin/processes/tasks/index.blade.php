@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@push('scripts')
    @script('js/page.admin.processes.tasks.index.js')
@endpush

@push('meta')
    @meta('processId', $process->id)
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\Processes\Tasks\Index($process),
])

@section('content')

    <div class="row justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h1>
                {!! \App\icon\processes(['mr-2']) !!}{{ $process->name }}
            </h1>

            <div class="card document">

                <div class="card-body">

                    <h2>
                        {!! \App\icon\tasks(['mr-2']) !!}{{ __('admin.tasks') }}
                    </h2>

                    <hr>

                    @if (count($process->tasks) > 0)

                        <p class="text-right">
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.processes.tasks.create', [$process]) }}">
                                {!! \App\icon\circlePlus(['mr-1']) !!}{{ __('admin.addTask') }}
                            </a>
                        </p>

                        @foreach ($process->tasks as $task)

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

                        @endforeach

                    @else

                        <div class="row justify-content-center">

                            <div class="col-12 col-sm-10">

                                <div class="card">
                                    <div class="card-body text-center">

                                        <div class="empty-resource">
                                            {!! \App\icon\tasks(['empty-resource-icon']) !!}
                                        </div>

                                        <p>{{ __('admin.task_description') }}</p>

                                        <hr>

                                        <a class="btn btn-primary" href="{{ route('admin.processes.tasks.create', [$process]) }}">{{ __('admin.task_createFirstTaskForProcessNow') }}</a>
                                    </div>
                                </div>

                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

@endsection
