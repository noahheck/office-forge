@extends("layouts.admin")

@push('scripts')
{{--    @script('js/page.admin.processes.tasks.show.js')--}}
@endpush

@push('styles')
    @style('css/admin.files.css')
@endpush

@push('meta')
    @meta('fileTypeId', $fileType->id)
    @meta('formId', $form->id)
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FileTypes\Forms\Show($fileType, $form),
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <div class="card">
                <div class="card-body">

                    <h2>
                        <span class="far fa-list-alt mr-2"></span>{{ $form->name }}
                    </h2>

                    <hr>

                    <div class="d-flex justify-content-between">

                        <span>
                            <span class="far fa-{{ $form->active ?? false ? 'check-' : '' }}square mr-1"></span>{{ __('file.form_active') }}
                        </span>

                        <a href="{{ route('admin.file-types.forms.edit', [$fileType, $form]) }}" class="btn btn-sm btn-primary">
                            <span class="fas fa-edit"></span> {{ __('admin.editForm') }}
                        </a>

                    </div>

                    <hr>

                    <div class="d-flex">
                        <h3 class="h4 flex-grow-1">
                            <span class="fas fa-pen-square mr-2"></span>{{ __('file.fields') }}
                        </h3>
                        <a href="{{ route('admin.file-types.forms.fields.index', [$fileType, $form]) }}">
                            <span class="far fa-arrow-alt-circle-right mr-1"></span>{{ __('file.fields') }}
                        </a>
                    </div>




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

                            <div class="col-12 col-sm-10 col-lg-8">

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




                    {{--@forelse ($task->actions as $action)

                        @if ($loop->first)
                            <ul class="list-group" id="taskActions">
                        @endif
                            <li class="d-flex list-group-item" data-id="{{ $action->id }}">
                                <div class="flex-grow-1">
                                    <span class="far fa-square"></span>
                                    <a href="{{ route('admin.processes.tasks.actions.show', [$process, $task, $action]) }}">{{ $action->name }}</a>
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


                    @empty

                        <div class="text-center border p-4">

                            <p>{{ __('admin.action_description') }}</p>

                        </div>

                    @endforelse

                    <div class="text-right mt-3">
                        <a href="{{ route('admin.processes.tasks.actions.create', [$process, $task]) }}" class="btn btn-sm btn-primary">
                            <span class="fas fa-plus"></span> {{ __('admin.addAction') }}
                        </a>
                    </div>--}}

                </div>
            </div>

        </div>
    </div>
@endsection
