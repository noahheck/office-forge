@extends("layouts.admin")

@push('styles')
    @style('css/document.css')
@endpush

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FileTypes\Forms\Fields\Show($fileType, $form, $field),
])

@include('admin._fields.show', [
    'field' => $field,
    'fieldEditRouteName' => 'admin.file-types.forms.fields.edit',
    'fieldEditRouteParams' => [$fileType, $form, $field],
])
