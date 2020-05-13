@extends("layouts.admin")

@push('scripts')
    @script('js/page.admin.form-docs.fields.index.js')
@endpush

@push('styles')
    @style('css/document.css')
@endpush

@push('meta')
    @meta('formDocId', $template->id)
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FormDocs\Fields\Index($template),
])

@include('admin._fields.index', [
    'formStructure' => $template,
    'formIconFunction' => '\App\icon\formDocs',
    'newFieldRouteName' => 'admin.form-docs.fields.create',
    'newFieldRouteParams' => [$template],
    'fieldEditRouteName' => 'admin.form-docs.fields.edit',
    'fieldEditRouteParams' => [$template],
    'emptyResourceFieldDescription' => __('formDoc.field_description'),
    'emptyResourceFieldTypeDescription' => __('formDoc.field_typesDescription'),
])
