@extends("layouts.admin")

@push('meta')
    @meta('fileTypeId', $fileType->id)
@endpush

@push('styles')
    @style('css/admin.files.css')
@endpush

@push('scripts')
    @script('js/page.admin.file-types.forms.index.js')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FileTypes\Forms\Index($fileType),
])

@section('content')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-xl-8">

            <h1>
                {!! $fileType->icon() !!} {{ $fileType->name }}
            </h1>

            <div class="card">

                <div class="card-body">

                    <div class="d-flex">

                        <h2 class="flex-grow-1 mb-0">
                            <span class="far fa-list-alt mr-2"></span>{{ __('admin.forms') }}
                        </h2>

                        <a href="{{ route('admin.file-types.forms.create', [$fileType]) }}" class="btn btn-primary">
                            <span class="fas fa-plus mr-2"></span>{{ __('admin.newForm') }}
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
                                        <span class="fas fa-arrows-alt-v"></span>
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
                                            <span class="far fa-list-alt empty-resource-icon"></span>
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
