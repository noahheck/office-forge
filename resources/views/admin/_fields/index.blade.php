@push('styles')
    @style('css/admin._field.css')
@endpush

@section('content')

    <div class="row justify-content-center form-preview document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h1>
                {!! $formIconFunction(['mr-2']) !!}{{ $formStructure->name }}
            </h1>

            <div class="card document">

                <div class="card-body">

                    <div class="d-flex">

                        <h2 class="flex-grow-1 mb-0">
                            {!! \App\icon\formFields(['mr-2']) !!}{{ __('file.fields') }}
                        </h2>

                        <a href="{{ route($newFieldRouteName, $newFieldRouteParams) }}" class="btn btn-primary">
                            {!! \App\icon\circlePlus(['mr-1']) !!}{{ __('admin.newField') }}
                        </a>

                    </div>

                    <hr>

                    @if ($formStructure->fields->count() > 0)

                        @foreach ($formStructure->fields->where('active', true) as $field)

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
                                <div class="d-flex flex-column pl-3 text-center flex-shrink-0">

                                    <div class="flex-grow-1">
                                        <a class="btn btn-sm btn-primary" href="{{ route($fieldEditRouteName, array_merge($fieldEditRouteParams, [$field])) }}">
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


                        @foreach ($formStructure->fields->where('active', false) as $field)

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
                                            <a class="btn btn-sm btn-secondary" href="{{ route($fieldEditRouteName, array_merge($fieldEditRouteParams, [$field])) }}">
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

                                        <p>{{ $emptyResourceFieldDescription }}</p>

                                        <p>{{ $emptyResourceFieldTypeDescription }}</p>

                                        <hr>

                                        <a class="btn btn-primary" href="{{ route($newFieldRouteName, $newFieldRouteParams) }}">{{ __('admin.field_createFirstFieldNow') }}</a>
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
