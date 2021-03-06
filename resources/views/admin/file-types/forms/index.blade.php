@extends("layouts.admin")

@push('meta')
    @meta('fileTypeId', $fileType->id)
@endpush

@push('styles')
    @style('css/admin.files.css')
    @style('css/document.css')
@endpush

@push('scripts')
    @script('js/page.admin.file-types.forms.index.js')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FileTypes\Forms\Index($fileType),
])

@section('content')

    <div class="row justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h1>
                {!! $fileType->icon(['mr-2']) !!}{{ $fileType->name }}
            </h1>

            <div class="card document">

                <div class="card-body">

                    <div class="d-flex">

                        <h2 class="flex-grow-1 mb-0">
                            {!! \App\icon\forms(['mr-2']) !!}{{ __('admin.forms') }}
                        </h2>

                        <a href="{{ route('admin.file-types.forms.create', [$fileType]) }}" class="btn btn-primary">
                            {!! \App\icon\circlePlus(['mr-1']) !!}{{ __('admin.newForm') }}
                        </a>

                    </div>

                    <hr>

                    @if ($fileType->forms->count() > 0)

                        <ul class="list-group" id="fileTypeForms">

                            @foreach ($fileType->forms as $form)

                                <li class="list-group-item d-flex" data-id="{{ $form->id  }}">
                                    <div class="flex-grow-1">
                                        <a href="{{ route('admin.file-types.forms.show', [$fileType, $form]) }}">{{ $form->name }}</a>
                                        @foreach ($form->teams as $team)
                                            {!! $team->icon() !!}
                                        @endforeach
                                    </div>
                                    <div class="sort-handle pl-3">
                                        {!! \App\icon\verticalSort() !!}
                                    </div>
                                </li>

                            @endforeach

                        </ul>

                    @else

                        <div class="row justify-content-center">

                            <div class="col-12 col-sm-10">

                                <div class="card">
                                    <div class="card-body text-center">

                                        <div class="empty-resource">
                                            {!! \App\icon\forms(['empty-resource-icon']) !!}
                                        </div>

                                        <p>{{ __('admin.form_description') }}</p>

                                        <hr>

                                        <a class="btn btn-primary" href="{{ route('admin.file-types.forms.create', [$fileType]) }}">{{ __('admin.form_createFirstFormNow') }}</a>
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
