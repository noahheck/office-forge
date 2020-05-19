@extends("layouts.app")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\FormDocs\Create)
])

@section('content')

    <div class="row justify-content-center">

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
                    </dl>

                    <hr>

                    @include('form-docs._form', [
                        'action' => route('form-docs.store'),
                        'fields' => $template->activeFields,
                        'values' => $formDoc->fields,
                        'valueKey' => 'form_doc_template_field_id',
                    ])

                </div>
            </div>
        </div>
    </div>
@endsection
