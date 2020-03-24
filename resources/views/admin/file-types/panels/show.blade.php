@extends("layouts.admin")

@push('scripts')
{{--    @script('js/page.admin.file-types.forms.show.js')--}}
@endpush

@push('styles')
    @style('css/admin.files.css')
@endpush

@push('meta')
    @meta('fileTypeId', $fileType->id)
    @meta('panelId', $panel->id)
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FileTypes\Panels\Show($fileType, $panel),
])

@section('content')

    <div class="row justify-content-center form-preview">

        <div class="col-12 col-md-10 col-xl-8">

            <div class="card">
                <div class="card-body">

                    <h2>
                        <span class="fas fa-th-list mr-2"></span>{{ $panel->name }}
                    </h2>

                    <hr>

                    <div class="d-flex justify-content-between">

                        {{--<span>
                            <span class="far fa-{{ $form->active ?? false ? 'check-' : '' }}square mr-1"></span>{{ __('file.form_active') }}
                        </span>--}}

                        <a href="{{ route('admin.file-types.panels.edit', [$fileType, $panel]) }}" class="btn btn-sm btn-primary">
                            <span class="fas fa-edit"></span> {{ __('admin.editPanel') }}
                        </a>

                    </div>

                    <hr>

                    {{--<strong>{{ __('file.form_teamAccessApproval') }}</strong>

                    @if ($form->teams->count() > 0)

                        <p>{{ __('file.form_teamAccessApprovalShortDescription') }}</p>
                        <ul class="list-group mb-3">
                            @foreach ($form->teams as $team)
                                <li class="list-group-item">{!! $team->icon() !!} {{ $team->name }}</li>
                            @endforeach
                        </ul>

                    @else

                        <p>{{ __('file.form_unrestrictedDescription') }}</p>

                        <hr>

                    @endif--}}

                    {{--<div class="d-flex">
                        <h3 class="h4 flex-grow-1">
                            <span class="fas fa-pen-square mr-2"></span>{{ __('file.fields') }}
                        </h3>
                    </div>--}}




                    {{--@if ($form->fields->count() > 0)

                        @foreach ($form->fields->where('active', true) as $field)

                            @if ($loop->first)
                                <ul class="list-group form-fields" id="formFields_active">
                            @endif

                                <li class="list-group-item d-flex form-field-list-item" data-id="{{ $field->id }}">
                                    <div class="flex-grow-1">

                                        @if ($field->separator)
                                            <hr class="separator">
                                        @endif

                                        @include('_form_field.' . $field->field_type, [
                                            'field' => $field,
                                            'value' => optional((object) []),
                                            'readonly' => true,
                                        ])

                                    </div>
                                    <div class="d-flex flex-column pl-3 text-center flex-shrink-0">

                                        <div class="flex-grow-1">
                                            <a class="btn btn-sm btn-primary" href="{{ route('admin.file-types.forms.fields.edit', [$fileType, $form, $field]) }}">
                                                <span class="fas fa-edit"></span> {{ __('app.edit') }}
                                            </a>
                                        </div>
                                        <div>
                                            <span class="sort-handle fas fa-arrows-alt-v"></span>
                                        </div>

                                    </div>
                                </li>

                            @if ($loop->last)
                                </ul>
                            @endif

                        @endforeach

                        <p class="text-right mt-3">
                            <a href="{{ route('admin.file-types.forms.fields.create', [$fileType, $form]) }}" class="btn btn-primary btn-sm">
                                <span class="fas fa-plus mr-2"></span>{{ __('admin.newField') }}
                            </a>
                        </p>


                        @foreach ($form->fields->where('active', false) as $field)

                            @if ($loop->first)

                                <h4 class="text-muted mt-4">{{ __('admin.inactive_fields') }}</h4>

                                <ul class="list-group form-fields" id="formFields_inactive">
                            @endif

                                <li class="list-group-item d-flex form-field-list-item" data-id="{{ $field->id }}">
                                    <div class="flex-grow-1">

                                        @if ($field->separator)
                                            <hr class="separator">
                                        @endif

                                        @include('_form_field.' . $field->field_type, [
                                            'field' => $field,
                                            'value' => optional((object) []),
                                            'readonly' => true,
                                        ])

                                    </div>
                                    <div class="d-flex flex-column pl-3 text-center flex-shrink-0">

                                        <div class="flex-grow-1">
                                            <a class="btn btn-sm btn-secondary" href="{{ route('admin.file-types.forms.fields.edit', [$fileType, $form, $field]) }}">
                                                <span class="fas fa-edit"></span> {{ __('app.edit') }}
                                            </a>
                                        </div>

                                    </div>
                                </li>

                            @if ($loop->last)
                                </ul>
                            @endif

                        @endforeach




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

                    @endif--}}

                </div>
            </div>

        </div>
    </div>
@endsection