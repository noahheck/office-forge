@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FormDocs\Fields\Show($template, $field),
])

@include('admin._fields.show', [
    'field' => $field,
    'fieldEditRouteName' => 'admin.form-docs.fields.edit',
    'fieldEditRouteParams' => [$template, $field],
])
