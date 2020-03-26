@extends("layouts.admin")

@push('scripts')
    @script('js/page.admin.file-types.panels.show.js')
@endpush

@push('styles')
    @style('css/admin.files.css')
@endpush

@push('meta')
    @meta('fileTypeId', $fileType->id)
    @meta('panelId', $panel->id)

    @foreach ($forms as $form)
        @meta('form_' . $form->id . '_fields', $form->fields->pluck('id'))
        @meta('form_' . $form->id, $form->fields)
    @endforeach
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

                        <span>
                            &nbsp;
                        </span>

                        <a href="{{ route('admin.file-types.panels.edit', [$fileType, $panel]) }}" class="btn btn-sm btn-primary">
                            <span class="fas fa-edit"></span> {{ __('admin.editPanel') }}
                        </a>

                    </div>

                    <hr>

                    <strong>{{ __('file.panel_teamAccessApproval') }}</strong>

                    @if ($panel->teams->count() > 0)

                        <p>{{ __('file.panel_teamAccessApprovalShortDescription') }}</p>
                        <ul class="list-group mb-3">
                            @foreach ($panel->teams as $team)
                                <li class="list-group-item">{!! $team->icon() !!} {{ $team->name }}</li>
                            @endforeach
                        </ul>

                    @else

                        <p>{{ __('file.panel_unrestrictedDescription') }}</p>

                        <hr>

                    @endif

                    <div class="d-flex">
                        <h3 class="h4 flex-grow-1">
                            <span class="fas fa-pen-square mr-2"></span>{{ __('file.fields') }}
                        </h3>
                    </div>

                    @if ($panel->fields->count() > 0)

                        @foreach ($panel->fields->where('active', true) as $field)

                            @if ($loop->first)
                                <ul class="list-group panel-fields" id="panelFields">
                            @endif

                                <li class="list-group-item d-flex form-field-list-item" data-id="{{ $field->id }}">
                                    <div class="flex-grow-1">

                                        @include('_panel_field.' . $field->field_type, [
                                            'field' => $field,
                                            'value' => optional((object) []),
                                            'preview' => true,
                                        ])

                                    </div>
                                    <div class="d-flex flex-column pl-3 text-center flex-shrink-0">

                                        <div class="flex-grow-1">
                                            <div class="dropdown">
                                                <button class="btn btn-outline-danger border-0 btn-sm" type="button" id="removeFieldDropdownMenuButton_{{ $field->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="fas fa-times"></span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="removeFieldDropdownMenuButton_{{ $field->id }}">
                                                    <form action="{{ route("admin.file-types.panels.remove-field", [$fileType, $panel, $field]) }}" method="POST">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <span class="far fa-trash-alt"></span>
                                                            {{ __('admin.panel_removeFieldFromPanel') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
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

                    @else

                        <div class="row justify-content-center">

                            <div class="col-12 col-sm-10 col-lg-8">

                                <div class="card">
                                    <div class="card-body text-center">

                                        <div class="empty-resource">
                                            <span class="fas fa-pen-square empty-resource-icon"></span>
                                        </div>

                                        <p>{{ __('admin.panel_description') }}</p>

                                        <p>{{ __('admin.panel_fieldsDescription') }}</p>

                                    </div>
                                </div>

                            </div>

                        </div>

                    @endif




                    <hr>

                    <div class="d-flex">
                        <h3 class="h4 flex-grow-1">
                            <span class="fas fa-pen-square mr-2"></span>{{ __('file.panel_addField') }}
                        </h3>
                    </div>

                    <form action="{{ route("admin.file-types.panels.add-field", [$fileType, $panel]) }}" method="POST" id="addFieldForm">

                        @csrf

                        <div class="row">

                            <div class="col-12 col-md-4">

                                @selectField([
                                    'name' => 'form_id',
                                    'label' => __('file.form'),
                                    'details' => '',
                                    'value' => '',
                                    'options' => $forms->pluck('name', 'id'),
                                    'placeholder' => '',
                                    'required' => false,
                                    'autofocus' => false,
                                    'error' => '',
                                    'readonly' => false,
                                ])

                            </div>

                            <div class="col-12 col-md-5">

                                @selectField([
                                    'name' => 'field_id',
                                    'label' => __('file.field'),
                                    'details' => '',
                                    'value' => '',
                                    'options' => [],//$forms->pluck('fields')->flatten()->pluck('label', 'id'),
                                    'placeholder' => '',
                                    'required' => true,
                                    'autofocus' => false,
                                    'error' => '',
                                    'readonly' => false,
                                ])

                            </div>

                            <div class="col-12 col-md-3 d-flex align-items-center">

                                <button type="submit" class="btn btn-primary">
                                    <span class="fas fa-plus"></span> {{ __('file.panel_addField') }}
                                </button>

                            </div>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
