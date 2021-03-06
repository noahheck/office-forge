@php
$__check = '';

if ($preview ?? false) {
    $__check = (Arr::random([true, false])) ? '-check' : '';
} else {
    $__check = ($value->value_boolean) ? '-check' : '';
}

@endphp
<div class="field">
    <span class="checkbox-container">
        <span class="far fa{{ $__check }}-square"></span>
    </span>
    <span class="field-label">{{ $field->label }}</span>
    @if ($field->description ?? false)
        <p class="mb-0">{{ $field->description }}</p>
    @endif
</div>
