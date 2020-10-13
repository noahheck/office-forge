@extends("layouts.app")

@push('styles')
    @style('css/document.css')
    @style('css/formDocs.css')
@endpush

@push('scripts')
    @script('js/page.form-docs.index.js')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\FormDocs\Index),
])

@section('content-body-class')
form-docs--index
@endsection

@section('content')

    <button class="form-docs--filters-display-button" id="formDocsFiltersDisplayButton">
        {!! \App\icon\filterOptions(['icon']) !!}
    </button>

    <button class="form-docs--list-display-button" id="formDocsListDisplayButton">
        {!! \App\icon\forms(['icon']) !!}
    </button>

    <div class="card shadow mb-3 form-docs--filters-container" id="formDocsFiltersContainer">
        <div class="card-body">

            <form class="bold-labels" action="" method="GET">

                <div class="container-fluid">

                    <div class="row">

                        <div class="col-12 col-md-6">

                            <div class="row mb-1">

                                <div class="col-2">
                                    @label([
                                        'for' => 'docs',
                                        'label' => __('app.show'),
                                    ])
                                </div>

                                <div class="col-10">
                                    @multiSelectField([
                                        'name' => 'docs',
                                        'label' => '',
                                        'values' => $selectedDocs,
                                        'options' => $templates->pluck('name', 'id'),
                                        'placeholder' => __('formDoc.allDocuments'),
                                        'description' => '',
                                        'required' => false,
                                        'autofocus' => true,
                                        'error' => $errors->has('docTypesToShow'),
                                        'fieldOnly' => true,
                                    ])
                                </div>

                            </div>

                        </div>

                        <div class="col-12 col-md-6">

                            <div class="row mb-1">

                                <div class="col-4 col-md-5 col-lg-4 col-xl-3">
                                    @label([
                                        'for' => 'users',
                                        'label' => __('formDoc.submittedBy'),
                                    ])
                                </div>

                                <div class="col-8 col-md-7 col-lg-8 col-xl-9">
                                    @userMultiSelectField([
                                        'name' => 'users',
                                        'label' => '',
                                        'values' => $selectedUsers,
                                        'users' => $userOptions,
                                        'placeholder' => __('formDoc.allUsers'),
                                        'description' => '',
                                        'required' => false,
                                        'autofocus' => false,
                                        'error' => $errors->has('users'),
                                        'fieldOnly' => true,
                                    ])
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">

                            <div class="d-flex">

                                <div class="flex-grow-0 p-2">
                                    @label([
                                        'for' => 'from',
                                        'label' => __('formDoc.between'),
                                    ])
                                </div>
                                <div class="flex-grow-1">
                                    @dateField([
                                        'name' => 'from',
                                        'label' => '',
                                        'details' => '',
                                        'value' => $from,
                                        'placeholder' => '',
                                        'required' => false,
                                        'autofocus' => false,
                                        'error' => $errors->has('from'),
                                        'readonly' => false,
                                        'fieldOnly' => true,
                                    ])
                                </div>

                                <div class="flex-grow-0 p-2">
                                    @label([
                                        'for' => 'to',
                                        'label' => __('formDoc.and'),
                                    ])
                                </div>

                                <div class="flex-grow-1">
                                    @dateField([
                                        'name' => 'to',
                                        'label' => '',
                                        'details' => '',
                                        'value' => $to,
                                        'placeholder' => '',
                                        'required' => false,
                                        'autofocus' => false,
                                        'error' => $errors->has('to'),
                                        'readonly' => false,
                                        'fieldOnly' => true,
                                    ])
                                </div>

                            </div>

                        </div>

                        <div class="col-12 col-md-6 d-flex">

                            <div class="flex-grow-1">
                                @checkboxSwitchField([
                                    'name' => 'includeDrafts',
                                    'id' => 'includeDrafts',
                                    'label' => __('formDoc.showInProgressFormDocs'),
                                    'details' => '',
                                    'checked' => (bool) $includeDrafts,
                                    'value' => '1',
                                    'required' => false,
                                    'error' => $errors->has('includeDrafts'),
                                ])
                            </div>

                            <div class="flex-grow-0">

                                <button type="submit" class="btn btn-primary">
                                    {{ __('app.go') }}
                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </form>

        </div>
    </div>

    <div class="row" data-controller="form-doc-display">

        @if (count($formDocs) > 0)

            <div class="col-md-4 d-md-block col-xl-3 form-docs--list-column" id="formDocsListColumn">

                <div class="form-docs--list-container">

                    <div class="form-docs--list-header">
                        {{ $formDocs->count() }} Entries
                    </div>

                    <div class="list-group form-docs--list">

                        @foreach($formDocs as $formDoc)

                            @php
                            $file = $formDoc->file;

                            if ($file && !Auth::user()->can('view', $file)) {

                                continue;
                            }

                            @endphp

                            <a id="formDocEntry_{{ $formDoc->id }}" class="form-doc--entry list-group-item list-group-item-action d-flex {{ ($formDoc->submitted_at) ? 'submitted' : 'in-progress' }}" href="{{ route('form-docs.show', [$formDoc]) }}" title="{{ $formDoc->name }} - {{ ($formDoc->submitted_at ?? false) ? __('formDoc.submitted') . ': ' . \App\format_datetime($formDoc->submitted_at) : __('formDoc.inProgress') }}" data-form-doc-id="{{ $formDoc->id }}" data-target="form-doc-display.link" data-action="form-doc-display#load">

                                <div class="icon-container px-2">
                                    <span class="form-doc--icon">
                                        {!! \App\icon\formDocs([]) !!}
                                    </span>
                                </div>
                                <div class="flex-grow-1 min-width-0">
                                    <span class="form-doc--title">{{ $formDoc->name }}</span>
                                    <p class="mb-0 overflow-x-ellipsis">
                                        {!! $formDoc->creator->icon(['mhw-25p']) !!}
                                        {{ $formDoc->date }} {{ $formDoc->time }}
                                    </p>
                                    @if ($file)
                                        <p class="mt-1 mb-0 overflow-x-ellipsis">
                                            {!! $file->icon(['mr-2', 'mhw-25p']) !!}{{ $file->name }}
                                        </p>
                                    @endif
                                </div>
                            </a>

                        @endforeach

                    </div>

                </div>

            </div>

            <div class="col-12 col-md-8 col-xl-9 d-flex justify-content-center">

                <div class="document-container form-docs--display-container" id="formDocsDisplayContainer">

                    <div class="card shadow document">
                        <div class="card-body" data-target="form-doc-display.displayContainer">
                            <em>{{ __('formDoc.selectFormDocFromListToView') }}</em>
                        </div>

                    </div>

                </div>
            </div>

        @else
            <div class="col-12 col-md-6 offset-md-3">

                <div class="card">
                    <div class="card-body">
                        {{ __('app.noResults') }}
                    </div>
                </div>

            </div>
        @endif

    </div>

@endsection
