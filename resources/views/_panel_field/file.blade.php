@php
    $__file = ($preview ?? false) ? \App\dummyFile($field->fileTypeId()) : optional($value->valueFile);
@endphp
<div class="panel-field">
    <span class="field-label">{{ $field->label }}</span>
    <div class="field-value">
        {!! $file->fileType->icon() !!} {{ $__file->name }}
    </div>
</div>
