{{--
@hiddenField([
    'name' => 'string: form field name',
    'id' => 'string: form field id',
    'value' => 'string: the field's value',
])
--}}
<input type="hidden" name="{{ $name }}" id="{{ $id ?? $name }}" value="{{ $value ?? '' }}">
