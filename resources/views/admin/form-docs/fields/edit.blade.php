@extends("layouts.admin")

@push('styles')
    @style('css/admin.files.css')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FormDocs\Fields\Edit($formDoc, $field),
])

@include('admin._fields.edit', [
    'field' => $field,
    'fieldUpdateRouteName' => 'admin.form-docs.fields.update',
    'fieldUpdateRouteParams' => [$formDoc, $field],
])
