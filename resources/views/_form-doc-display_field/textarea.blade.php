@php
    $__value = ($preview ?? false) ? \App\misc_longtext() : $value->value_longtext;
    $__value = nl2br(e($__value));
@endphp
<div class="field">
    <span class="field-label">{{ $field->label }}</span>
    <div class="field-value">
        {!! $__value !!}
    </div>
</div>
