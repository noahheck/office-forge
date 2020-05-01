@extends("layouts.admin")

@push('scripts')
    @script('js/page.admin.file-types.panels.show.js')
@endpush

@push('styles')
    @style('css/admin.files.css')
    @style('css/document.css')
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

    <div class="row justify-content-center form-preview document-print-container">

        <div class="col-12 col-md-10 document-container">

            <div class="card document">
                <div class="card-body">

                    <h2>
                        {!! \App\icon\fileDetails(['mr-2']) !!}{{ $panel->name }}
                    </h2>

                    <hr>

                    <div class="d-flex justify-content-between">

                        <span>
                            &nbsp;
                        </span>

                        <a href="{{ route('admin.file-types.panels.edit', [$fileType, $panel]) }}" class="btn btn-sm btn-primary">
                            {!! \App\icon\edit(['mr-1']) !!}{{ __('admin.editPanel') }}
                        </a>

                    </div>

                    <hr>


                    @if ($panel->teams->count() > 0)

                        <strong>{!! \App\icon\teams(['mr-2']) !!}{{ __('file.panel_teamAccessApproval') }}</strong>

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
                            {!! \App\icon\formFields(['mr-2']) !!}{{ __('file.fields') }}
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
                                                    {!! \App\icon\x() !!}
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="removeFieldDropdownMenuButton_{{ $field->id }}">
                                                    <form action="{{ route("admin.file-types.panels.remove-field", [$fileType, $panel, $field]) }}" method="POST">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            {!! \App\icon\trash() !!}
                                                            {{ __('admin.panel_removeFieldFromPanel') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            {!! \App\icon\verticalSort(['sort-handle']) !!}
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
                                            {!! \App\icon\formFields(['empty-resource-icon']) !!}
                                        </div>

                                        <p>{{ __('admin.panel_description') }}</p>

                                    </div>
                                </div>

                            </div>

                        </div>

                    @endif



                    <div class="card shadow mt-5">

                        <div class="card-body">

                            <div class="d-flex">
                                <h3 class="h4 flex-grow-1">
                                    {!! \App\icon\formFields(['mr-2']) !!}{{ __('file.panel_addField') }}
                                </h3>
                            </div>

                            <hr>

                            <form action="{{ route("admin.file-types.panels.add-field", [$fileType, $panel]) }}" method="POST" id="addFieldForm">

                                @csrf

                                <div class="row">

                                    <div class="col-12">
                                        <p class="text-center">{{ __('admin.panel_fieldsDescription') }}</p>
                                        <hr>
                                    </div>

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
                                            {!! \App\icon\circlePlus(['mr-1']) !!}{{ __('file.panel_addField') }}
                                        </button>

                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
