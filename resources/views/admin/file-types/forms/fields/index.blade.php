@extends("layouts.admin")

@push('scripts')
    @script('js/page.admin.processes.tasks.actions.index.js')
@endpush

@push('styles')
    @style('css/admin.files.css')
@endpush

@push('meta')
    @meta('fileTypeId', $fileType->id)
    @meta('formId', $form->id)
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FileTypes\Forms\Fields\Index($fileType, $form),
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <h1>
                <span class="far fa-list-alt"></span> {{ $form->name }}
            </h1>

            <div class="card">

                <div class="card-body">

                    <div class="d-flex">

                        <h2 class="flex-grow-1 mb-0">
                            <span class="fas fa-pen-square mr-2"></span>{{ __('file.fields') }}
                        </h2>

                        <a href="{{ route('admin.file-types.forms.fields.create', [$fileType, $form]) }}" class="btn btn-primary">
                            <span class="fas fa-plus mr-2"></span>{{ __('admin.newField') }}
                        </a>

                    </div>

                    <hr>

                    @if ($form->fields->count() > 0)

                        <ul class="list-group">

                            @foreach ($form->fields as $field)

                                <li class="list-group-item d-flex">
                                    <div class="flex-grow-1">
                                        <a href="{{ route('admin.file-types.forms.fields.show', [$fileType, $form, $field]) }}">
                                            {{ $field->label }}
                                        </a>
                                        {!! $field->preview() !!}
                                    </div>
                                    <div class="sort-handle pl-3">
                                        <span class="fas fa-arrows-alt-v"></span>
                                    </div>
                                </li>

                            @endforeach

                        </ul>

                    @else

                        <div class="row justify-content-center">

                            <div class="col-12 col-sm-10">

                                <div class="card">
                                    <div class="card-body text-center">

                                        <div class="empty-resource">
                                            <span class="fas fa-pen-square empty-resource-icon"></span>
                                        </div>

                                        <p>{{ __('admin.field_description') }}</p>

                                        <p>{{ __('admin.field_typesDescription') }}</p>

                                        <hr>

                                        <a class="btn btn-primary" href="{{ route('admin.file-types.forms.fields.create', [$fileType, $form]) }}">{{ __('admin.field_createFirstFieldNow') }}</a>
                                    </div>
                                </div>

                            </div>

                        </div>

                    @endif

                </div>

            </div>

            {{--<div class="card">

                <div class="card-body">

                    <h2>
                        <span class="fas fa-tasks"></span>
                        {{ __('admin.actions') }}
                    </h2>

                    <hr>

                    @if (count($task->actions) > 0)

                        <p class="text-right">
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.processes.tasks.actions.create', [$process, $task]) }}">
                                <span class="fas fa-plus"></span> {{ __('admin.addAction') }}
                            </a>
                        </p>

                        @foreach ($task->actions as $action)

                            @if ($loop->first)
                                <ul class="list-group" id="taskActions">
                            @endif

                                <li class="list-group-item d-flex" data-id="{{ $action->id }}">
                                    <div class="flex-grow-1">
                                        <span class="far fa-square"></span>
                                        <a href="{{ route('admin.processes.tasks.actions.show', [$process, $task, $action]) }}">
                                            {{ $action->name }}
                                        </a>
                                        @if ($action->details)
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
                                            <span class="fas fa-check-square empty-resource-icon"></span>
                                        </div>

                                        <p>{{ __('admin.action_description') }}</p>

                                        <hr>

                                        <a class="btn btn-primary" href="{{ route('admin.processes.tasks.actions.create', [$process, $task]) }}">{{ __('admin.action_createFirstActionForTaskNow') }}</a>
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
