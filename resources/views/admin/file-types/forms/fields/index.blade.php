@extends("layouts.admin")

@push('scripts')
    @script('js/page.admin.file-types.forms.fields.index.js')
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

    <div class="row justify-content-center form-preview">

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

                        @foreach ($form->fields->where('active', true) as $field)

                            @if ($loop->first)
                                <ul class="list-group form-fields" id="formFields_active">
                            @endif

                            <li class="list-group-item d-flex form-field-list-item" data-id="{{ $field->id }}">
                                <div class="flex-grow-1">

                                    @include('_form_field.' . $field->field_type, [
                                        'field' => $field,
                                        'value' => optional((object) []),
                                        'readonly' => true,
                                    ])

                                </div>
                                <div class="d-flex flex-column pl-3 text-center">

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


                            @foreach ($form->fields->where('active', false) as $field)

                                @if ($loop->first)

                                    <hr class="mt-5">
                                    <h4 class="text-muted mssst-4">{{ __('admin.inactive_fields') }}</h4>

                                    <ul class="list-group form-fields" id="formFields_inactive">
                                @endif

                                    <li class="list-group-item d-flex form-field-list-item" data-id="{{ $field->id }}">
                                        <div class="flex-grow-1">

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


        </div>

    </div>

@endsection
