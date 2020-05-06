@extends("layouts.admin")

@push('scripts')
{{--    @script('js/page.admin.file-types.forms.fields.index.js')--}}
@endpush

@push('styles')
{{--    @style('css/admin.files.css')--}}
    @style('css/document.css')
@endpush

@push('meta')
    @meta('formDocId', $formDoc->id)
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FormDocs\Fields\Index($formDoc),
])

@include('admin._fields.index', [
    'formStructure' => $formDoc,
    'formIconFunction' => '\App\icon\formDocs',
    'newFieldRouteName' => 'admin.form-docs.fields.create',
    'newFieldRouteParams' => [$formDoc],
    'fieldEditRouteName' => 'admin.form-docs.fields.edit',
    'fieldEditRouteParams' => [$formDoc],
    'emptyResourceFieldDescription' => __('formDoc.field_description'),
    'emptyResourceFieldTypeDescription' => __('formDoc.field_typesDescription'),
])
