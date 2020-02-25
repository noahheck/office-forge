@extends("layouts.admin")

@push('scripts')
{{--    @script('js/page.admin.processes.show.js')--}}
@endpush

@push('styles')
    @style('css/admin.files.css')
@endpush

@push('meta')
    @meta('fileTypeId', $fileType->id)
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FileTypes\Show($fileType),
])

@section('content')

    <div class="row fileType-show">

        <div class="col-12 col-md-4 col-xl-3">

            <div class="card">

                <div class="card-body">

                    <h1 class="h3">{!! $fileType->icon(['mr-2']) !!}{{ $fileType->name }}</h1>

                    <hr>

                    <a class="btn btn-block btn-primary" href="{{ route('admin.file-types.edit', [$fileType]) }}">
                        {{ __('admin.editFileType') }}
                    </a>

                </div>

            </div>

        </div>

        <div class="col-12 col-md-8 col-xl-9 mt-3 mt-md-0">

            <div class="row">

                <div class="col-12 col-xl-6">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex">

                                <h3 class="h4 flex-grow-1 mb-0">
                                    <span class="far fa-list-alt mr-2"></span>{{ __("file.forms") }}
                                        <a href="{{ route('admin.file-types.forms.index', [$fileType]) }}">
                                            <span class="far fa-arrow-alt-circle-right"></span>
                                        </a>
                                </h3>

                                <a href="{{ route('admin.file-types.forms.create', [$fileType]) }}" class="btn btn-sm btn-primary">
                                    <span class="fas fa-plus mr-2"></span>{{ __('admin.newForm') }}
                                </a>

                            </div>
                            <hr>

                            @if($fileType->forms->count() > 0)

                                <ul class="list-group fileType-forms-list-group">

                                    @foreach ($fileType->forms as $form)

                                        <li class="list-group-item">
                                            <a href="{{ route('admin.file-types.forms.show', [$fileType, $form]) }}">{{ $form->name }}</a>
                                            {{-- Will be outputting the team restrictions here as well --}}
                                        </li>

                                    @endforeach

                                </ul>

                            @else

                                <div class="text-center">

                                    <div class="empty-resource">
                                        <span class="far fa-list-alt empty-resource-icon"></span>
                                    </div>

                                    <p>{{ __('admin.form_description') }}</p>

                                    <hr>

                                    <a class="btn btn-primary" href="{{ route('admin.file-types.forms.create', [$fileType]) }}">{{ __('admin.form_createFirstFormNow') }}</a>

                                </div>

                            @endif


                        </div>

                    </div>


                </div>

            </div>

        </div>

    </div>
@endsection
