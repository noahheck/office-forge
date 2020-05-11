@extends("layouts.app")

@push('styles')
    @style('css/document.css')
    @style('css/formDocs.css')
@endpush

@push('scripts')
{{--    @script('js/page.activities.show.js')--}}
@endpush

@push('meta')
    @meta('formDocId', $formDoc->id)
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\FormDocs\Show($formDoc))
])

@section('content')

    <div class="row project justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">
            <div class="card shadow document">
                <div class="card-body">

                    <h2>{!! \App\icon\formDocs(['mr-2']) !!}{{ $formDoc->name }}</h2>

                    <hr>

                    <dl class="row">
                        @if ($file)
                            <dt class="col-12 col-sm-3 col-xl-2 text-sm-right">{{ $file->fileType->name }}:</dt>
                            <dd class="col-12 col-sm-9 col-xl-10">{!! $file->icon(['mhw-35p', 'mr-2']) !!}{{ $file->name }}</dd>
                        @endif

                        <dt class="col-12 col-sm-3 col-xl-2 text-sm-right">{{ __('formDoc.creator') }}:</dt>
                        <dd class="col-12 col-sm-9 col-xl-10">{!! $formDoc->creator->icon(['mhw-35p', 'mr-2']) !!}{{ $formDoc->creator->name }}</dd>

                        @if ($formDoc->isSubmitted())
                            <dt class="col-12 col-sm-3 col-xl-2 text-sm-right">{{ __('formDoc.submitted') }}</dt>
                            <dd class="col-12 col-sm-9 col-xl-10">{{ \App\format_datetime($formDoc->submitted_at) }}</dd>
                        @endif
                    </dl>

                    <hr>

                    <div class="formDoc--fields">
                        @foreach ($formDoc->fields as $field)

                            @if ($field->separator)
                                <hr class="separator">
                            @endif

                            @include('_panel_field.' . $field->field_type, [
                                'field' => $field,
                                'value' => $field,
                                'preview' => false,
                            ])
                        @endforeach
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
