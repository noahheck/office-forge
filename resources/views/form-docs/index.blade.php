@extends("layouts.app")

@push('styles')
    @style('css/document.css')
    @style('css/formDocs.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\FormDocs\Index),
])

@section('content-body-class')
form-docs--index
@endsection

@section('content')

    <div class="card mb-3 form-docs--filters-container">
        <div class="card-body">

            <form class="bold-labels" action="" method="GET">

                <div class="container-fluid">

                    <div class="row">

                        <div class="col-12 col-md-6">

                            <div class="row mb-1">

                                <div class="col-2">
                                    @label([
                                        'for' => 'docTypesToShow',
                                        'label' => 'Show',
                                    ])
                                </div>

                                <div class="col-10">
                                    @multiSelectField([
                                        'name' => 'docs',
                                        'label' => 'Show',
                                        'values' => $selectedDocs,
                                        'options' => $templates->pluck('name', 'id'),
                                        'placeholder' => 'All Documents',
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
                                        'label' => 'Submitted By',
                                    ])
                                </div>

                                <div class="col-8 col-md-7 col-lg-8 col-xl-9">
                                    @userMultiSelectField([
                                        'name' => 'users',
                                        'label' => 'Submitted By',
                                        'values' => $selectedUsers,
                                        'users' => $userOptions,
                                        'placeholder' => 'All Users',
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
                                        'label' => 'Between',
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
                                        'label' => 'and',
                                    ])
                                </div>

                                <div class="flex-grow-1">
                                    @dateField([
                                        'name' => 'to',
                                        'label' => 'and',
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
                                    'label' => 'Show In Progress FormDocs',
                                    'details' => '',
                                    'checked' => (bool) $includeDrafts,
                                    'value' => '1',
                                    'required' => false,
                                    'error' => $errors->has('includeDrafts'),
                                ])
                            </div>

                            <div class="flex-grow-0">

                                <button type="submit" class="btn sssbtn-sm btn-primary">
                                    {{ __('app.view') }}
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

            <div class="col-12 col-sm-4 col-xl-3 form-docs--list-container">

                <div class="list-group form-docs--list">

                    @foreach($formDocs as $formDoc)

                        @php
                        $file = $formDoc->file;

                        if ($file && !Auth::user()->can('view', $file)) {

                            continue;
                        }

                        @endphp

                        <a class="list-group-item list-group-item-action d-flex {{ ($formDoc->submitted_at) ? 'submitted' : 'in-progress' }}" href="{{ route('form-docs.show', [$formDoc]) }}" title="{{ ($formDoc->submitted_at ?? false) ? 'Submitted: ' . \App\format_datetime($formDoc->submitted_at) : 'In Progress' }}" data-form-doc-id="{{ $formDoc->id }}" data-action="form-doc-display#load">

                            <div class="icon-container px-2">
                                <span class="form-doc--icon">

                                {!! \App\icon\formDocs([]) !!}
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <span class="form-doc--title">{{ $formDoc->name }}</span>
                                <p class="mb-0">
                                    {!! $formDoc->creator->icon(['mhw-25p']) !!}
                                    {{ $formDoc->date }} {{ $formDoc->time }}
                                </p>
                                @if ($file)
                                    <p class="mt-1 mb-0">
                                        {!! $file->icon(['mr-2', 'mhw-25p']) !!}{{ $file->name }}
                                    </p>
                                @endif
                            </div>
                        </a>

                    @endforeach

                </div>

            </div>

            <div class="col-12 col-sm-8 col-xl-9 d-flex justify-content-center">

                <div class="document-container form-docs--display-container" id="formDocsDisplayContainer">

                    <div class="card shadow document">
                        <div class="card-body" data-target="form-doc-display.displayContainer">

                        </div>

                    </div>

                </div>
            </div>

        @else
            <div class="col-12 col-md-6 offset-md-3">

                <div class="card">
                    <div class="card-body">
                        No results
                    </div>
                </div>

            </div>
        @endif

    </div>

@endsection
