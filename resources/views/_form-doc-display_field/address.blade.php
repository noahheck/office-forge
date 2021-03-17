@php
    $__addressParts = ($preview ?? false) ? \App\misc_address() : $value->valueAddress();
    $__addressParts = ($__addressParts) ? $__addressParts : [];
    $__address = implode("<br>", array_map('e', $__addressParts));
@endphp
<div class="field">
    <span class="field-label">{{ $field->label }}</span>
    <div class="field-value">
        {!! $__address !!}
    </div>
</div>
