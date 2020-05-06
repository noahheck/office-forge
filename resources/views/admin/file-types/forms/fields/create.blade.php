@extends("layouts.admin")

@push('styles')
    @style('css/admin.files.css')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FileTypes\Forms\Fields\Create($fileType, $form),
])

@include('admin._fields.create', [
    'field' => $field,
    'fieldStoreRouteName' => 'admin.file-types.forms.fields.store',
    'fieldStoreRouteParams' => [$fileType, $form],
])
