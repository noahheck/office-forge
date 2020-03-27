@extends("layouts.app")

@push('meta')
    @meta('fileId', $file->id)
    @meta('fileTypeId', $fileType->id)
@endpush

@push('styles')
    @style('css/files.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\Files\Show($fileType, $file))
])

@section('content')

<div class="file">

    <h4 class="h5 text-muted pl-3">{!! $fileType->icon() !!} - {{ $fileType->name }}</h4>

    <div class="row file">

        <div class="col-12 col-md-4 col-xl-3 mb-3">

            <div class="card shadow mb-3">
                <div class="card-body">
                    <h3>{{ $file->name }}</h3>

                    <hr>

                    <div class="text-center">
                        {!! $file->thumbnail() !!}
                    </div>

                    <hr>

                    <div class="text-center">
                        <a class="btn btn-primary" href="{{ route('files.edit', [$file]) }}">
                            <span class="fas fa-edit mr-2"></span>{{ __('app.edit') }} {{ $fileType->name }}</a>
                    </div>
                </div>
            </div>

            @if ($forms->count() > 0)
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="mb-0">{{ __('file.forms') }}</h4>
                    </div>
                    <div class="list-group list-group-flush">
                        @foreach ($forms as $form)
                            <a href="{{ route('files.forms.show', [$file, $form]) }}" class="list-group-item list-group-item-action">{{ $form->name }}</a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>

        @if ($panels->count() > 0)
            <div class="col-12 col-md-8 col-xl-9">

                <div class="card shadow panels">
                    <div class="card-header">
                        <h4 class="mb-0">{{ __('file.details') }}</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">

                            <div class="col-12 col-sm-5 col-lg-4 col-xl-3 mb-3 mb-sm-0">
                                <div class="list-group panels-tabs" id="panelsTabs" role="tablist">
                                    @foreach ($panels as $panel)
                                        <a id="#panel_tab_{{ $panel->id }}" href="#panel_panel_{{ $panel->id }}" class="list-group-item list-group-item-action @if($loop->first) active @endif" data-toggle="list" role="tab" aria-controls="panel_panel_{{ $panel->id }}">{{ $panel->name }}</a>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-12 col-sm-7 col-lg-8 col-xl-9 border-left">

                                <div class="tab-content panels-content" id="panelsContent">
                                    @foreach ($panels as $panel)
                                        <div class="panel-fields tab-pane @if ($loop->first) show active @endif" id="panel_panel_{{ $panel->id }}" role="tabpanel" aria-labelledby="panel_tab_{{ $panel->id }}">
                                            <h4><span class="fas fa-th-list mr-2"></span>{{ $panel->name }}</h4>

                                            <hr>

                                            <div class="panel-content">
                                                @foreach ($panel->fields as $field)
                                                    @include('_panel_field.' . $field->field_type, [
                                                        'field' => $field,
                                                        'value' => optional($values->firstWhere('file_type_form_field_id', $field->id)),
                                                        'preview' => false,
                                                    ])
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            </div>
        @endif

    </div>

</div>

@endsection
