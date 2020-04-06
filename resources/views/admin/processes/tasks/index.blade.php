@extends("layouts.admin")

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

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <h1>
                <span class="fas fa-clipboard-list mr-2"></span>{{ $process->name }}
            </h1>

            <div class="card">

                <div class="card-body">

                    <h2>
                        <span class="fas fa-clipboard-check mr-2"></span>{{ __('admin.tasks') }}
                    </h2>

                    <hr>

                    @if (count($process->tasks) > 0)

                        <p class="text-right">
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.processes.tasks.create', [$process]) }}">
                                <span class="fas fa-plus"></span> {{ __('admin.addTask') }}
                            </a>
                        </p>

                        @foreach ($process->tasks as $task)

                            @if ($loop->first)
                                <ul class="list-group" id="processTasks">
                            @endif

                                <li class="list-group-item d-flex" data-id="{{ $task->id }}">
                                    <div class="flex-grow-1">
                                        <span class="far fa-square mr-2"></span>
                                        <a href="{{ route('admin.processes.tasks.show', [$process, $task]) }}">
                                            {{ $task->name }}
                                        </a>
                                        @if ($task->details)
                                            <span class="text-muted fas fa-align-left"></span>
                                        @endif

                                    </div>
                                    <div class="sort-handle">
                                        <span class="fas fa-arrows-alt-v"></span>
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
                                            <span class="fas fa-clipboard-check empty-resource-icon"></span>
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
