@php
    $__file = ($preview ?? false) ? \App\dummyFile($field->fileTypeId()) : $value->valueFile();
@endphp
<div class="panel-field">
    <span class="field-label">{{ $field->label }}</span>
    <div class="field-value">
        {{ $__file->name }}
    </div>
</div>
