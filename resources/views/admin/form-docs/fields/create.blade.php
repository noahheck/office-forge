@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FormDocs\Fields\Create($template),
])

@include('admin._fields.create', [
    'field' => $field,
    'fieldStoreRouteName' => 'admin.form-docs.fields.store',
    'fieldStoreRouteParams' => [$template],
])
