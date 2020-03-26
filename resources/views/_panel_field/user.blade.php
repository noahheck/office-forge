@php
    $__user = ($preview ?? false) ? \App\dummyUser() : $value->valueUser();
@endphp
<div class="panel-field">
    <span class="field-label">{{ $field->label }}</span>
    <div class="field-value">
        {!! $__user->iconAndName() !!}
    </div>
</div>
