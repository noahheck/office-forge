@extends("layouts.app")

@section('title'){{ $formDoc->name }}@endsection

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

                    @include('form-docs._form-doc')

                </div>

            </div>
        </div>

    </div>
@endsection
