@extends("layouts.admin")

@push('scripts')
    @script('js/page.admin.file-types.forms.fields.index.js')
@endpush

@push('styles')
    @style('css/admin.files.css')
    @style('css/document.css')
@endpush

@push('meta')
    @meta('fileTypeId', $fileType->id)
    @meta('formId', $form->id)
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FileTypes\Forms\Fields\Index($fileType, $form),
])

@include('admin._fields.index', [
    'formStructure' => $form,
    'formIconFunction' => '\App\icon\forms',
    'newFieldRouteName' => 'admin.file-types.forms.fields.create',
    'newFieldRouteParams' => [$fileType, $form],
    'fieldEditRouteName' => 'admin.file-types.forms.fields.edit',
    'fieldEditRouteParams' => [$fileType, $form],
    'emptyResourceFieldDescription' => __('admin.field_description'),
    'emptyResourceFieldTypeDescription' => __('admin.field_typesDescription'),
])
