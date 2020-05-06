@extends("layouts.admin")

@push('styles')
    @style('css/admin.files.css')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FileTypes\Forms\Fields\Edit($fileType, $form, $field),
])

@include('admin._fields.edit', [
    'field' => $field,
    'fieldUpdateRouteName' => 'admin.file-types.forms.fields.update',
    'fieldUpdateRouteParams' => [$fileType, $form, $field],
])
