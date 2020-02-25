@extends("layouts.admin")

@push('styles')
    @style('css/admin.files.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FileTypes\Forms\Index($fileType),
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <h1>
                {!! $fileType->icon() !!} {{ $fileType->name }}
            </h1>

            <div class="card">

                <div class="card-body">

                    <h2>
                        <span class="far fa-list-alt mr-2"></span>{{ __('admin.forms') }}
                    </h2>

                    <hr>

                    @if ($fileType->forms->count() > 0)

                        <ul class="list-group">

                            @foreach ($fileType->forms as $form)

                                <li class="list-group-item">
                                    <a href="{{ route('admin.file-types.forms.show', [$fileType, $form]) }}">{{ $form->name }}</a>
                                    {{-- Will be outputting the team restrictions here as well --}}
                                </li>

                            @endforeach

                        </ul>

                    @else

                        <div class="row justify-content-center">

                            <div class="col-12 col-sm-10">

                                <div class="card">
                                    <div class="card-body text-center">

                                        <div class="empty-resource">
                                            <span class="far fa-list-alt empty-resource-icon"></span>
                                        </div>

                                        <p>{{ __('admin.form_description') }}</p>

                                        <hr>

                                        <a class="btn btn-primary" href="{{ route('admin.file-types.forms.create', [$fileType]) }}">{{ __('admin.form_createFirstFormNow') }}</a>
                                    </div>
                                </div>

                            </div>

                        </div>

                    @endif

                </div>

            </div>

            {{--<h1>
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

                                        <br>

                                        <span class="text-muted"><span class="fas fa-tasks"></span> {{ $numActions = count($task->actions->where('active', true)) }} {{ __('process.action' . (($numActions == 1) ? '' : 's')) }}</span>
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

            </div>--}}

        </div>

    </div>

@endsection