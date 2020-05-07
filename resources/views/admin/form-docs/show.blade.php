@extends("layouts.admin")

@push('scripts')
    @script('js/page.admin.form-docs.show.js')
@endpush

@push('styles')
    @style('css/document.css')
    @style('css/admin._field.css')
@endpush

@push('meta')
    @meta('formDocId', $formDoc->id)
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FormDocs\Show($formDoc),
])

@section('content')

    <div class="row justify-content-center form-preview document-print-container">

        <div class="col-12 col-md-10 document-container">

            <div class="card document">
                <div class="card-body">

                    <h2>
                        {!! \App\icon\formDocs(['mr-2']) !!}{{ $formDoc->name }}
                    </h2>

                    @if ($fileType = $formDoc->fileType)
                        <h5 class="pl-4">{!! $fileType->icon(['mr-2']) !!}<a href="{{ route('admin.file-types.show', [$fileType]) }}">{{ $fileType->name }}</a></h5>
                    @endif

                    <hr>

                    <div class="d-flex justify-content-between">

                        <span>
                            @if ($formDoc->active)
                                {!! \App\icon\checkedBox(['mr-1']) !!}{{ __('formDoc.active') }}
                            @else
                                {!! \App\icon\uncheckedBox(['mr-1']) !!}{{ __('formDoc.active') }}
                            @endif
                        </span>

                        <a href="{{ route('admin.form-docs.edit', [$formDoc]) }}" class="btn btn-sm btn-primary">
                            {!! \App\icon\edit(['mr-1']) !!}{{ __('admin.editFormDoc') }}
                        </a>

                    </div>

                    <hr>


                    @if ($formDoc->teams->count() > 0)

                        <strong>{!! \App\icon\teams(['mr-2']) !!}{{ __('formDoc.teamAccessApproval') }}</strong>

                        <p>{{ __('formDoc.teamAccessApprovalShortDescription') }}</p>
                        <ul class="list-group mb-3">
                            @foreach ($formDoc->teams as $team)
                                <li class="list-group-item">{!! $team->icon() !!} {{ $team->name }}</li>
                            @endforeach
                        </ul>

                    @else

                        <p>{{ __('formDoc.unrestrictedDescription') }}</p>

                    @endif

                    <hr>

                    <div class="d-flex mt-3 mb-3">
                        <h3 class="h4 flex-grow-1">
                            {!! \App\icon\formFields(['mr-2']) !!}{{ __('formDoc.fields') }}
                            <a href="{{ route('admin.form-docs.fields.index', [$formDoc]) }}">{!! \App\icon\go() !!}</a>
                        </h3>
                        <div class="flex-grow-0">
                            <a href="{{ route('admin.form-docs.fields.create', [$formDoc]) }}" class="btn btn-sm btn-outline-primary">
                                {!! \App\icon\circlePlus(['mr-1']) !!}{{ __('admin.newField') }}
                            </a>
                        </div>
                    </div>




                    @if ($formDoc->fields->count() > 0)

                        @foreach ($formDoc->fields->where('active', true) as $field)

                            @if ($loop->first)
                                <ul class="list-group form-fields" id="formDocFields_active">
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

                        <p class="text-right mt-3">
                            <a href="{{ route('admin.form-docs.fields.create', [$formDoc]) }}" class="btn btn-primary btn-sm">
                                {!! \App\icon\circlePlus(['mr-1']) !!}{{ __('admin.newField') }}
                            </a>
                        </p>


                        @foreach ($formDoc->fields->where('active', false) as $field)

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

                            <div class="col-12 col-sm-10 col-lg-8">

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
