@extends("layouts.admin")

@push('scripts')
{{--    @script('js/page.admin.file-types.forms.fields.index.js')--}}
@endpush

@push('styles')
{{--    @style('css/admin.files.css')--}}
    @style('css/document.css')
@endpush

@push('meta')
    @meta('formDocId', $formDoc->id)
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FormDocs\Fields\Index($formDoc),
])

@section('content')

    <div class="row justify-content-center form-preview document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h1>
                {!! \App\icon\formDocs(['mr-2']) !!}{{ $formDoc->name }}
            </h1>

            <div class="card document">

                <div class="card-body">

                    <div class="d-flex">

                        <h2 class="flex-grow-1 mb-0">
                            {!! \App\icon\formFields(['mr-2']) !!}{{ __('formDoc.fields') }}
                        </h2>

                        <a href="{{ route('admin.form-docs.fields.create', [$formDoc]) }}" class="btn btn-primary">
                            {!! \App\icon\circlePlus(['mr-1']) !!}{{ __('admin.newField') }}
                        </a>

                    </div>

                    <hr>

                    @if ($formDoc->fields->count() > 0)

                        @foreach ($formDoc->fields->where('active', true) as $field)

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
                                        <a class="btn btn-sm btn-primary" href="{{ route('admin.form-docs.fields.edit', [$formDoc, $field]) }}">
                                            {!! \App\icon\edit(['mr-1']) !!}{{ __('app.edit') }}
                                        </a>
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


                        @foreach ($formDoc->fields->where('active', false) as $field)

                            @if ($loop->first)

                                <hr class="mt-5">
                                <h4 class="text-muted">{{ __('admin.inactive_fields') }}</h4>

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
                                            <a class="btn btn-sm btn-secondary" href="{{ route('admin.form-docs.fields.edit', [$formDoc, $field]) }}">
                                                {!! \App\icon\edit(['mr-1']) !!}{{ __('app.edit') }}
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
                                            {!! \App\icon\formFields(['empty-resource-icon']) !!}
                                        </div>

                                        <p>{{ __('formDoc.field_description') }}</p>

                                        <p>{{ __('formDoc.field_typesDescription') }}</p>

                                        <hr>

                                        <a class="btn btn-primary" href="{{ route('admin.form-docs.fields.create', [$formDoc]) }}">{{ __('admin.field_createFirstFieldNow') }}</a>
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
