{{--
@userSelectField([
    'name' => 'string: form field name',
    'label' => 'string: text label for form field',
    'value' => 'string: the field's value',
    'users' => 'Collection of users',
    'placeholder' => 'string: example placeholder text',
    'description' => 'string: additional details describing this field',
    'required' => 'boolean: whether the field is required',
    'autofocus' => 'boolean: whether the field should be focused on load',
    'error' => 'boolean: whether the field is in error state',
    'readonly' => 'boolean: whether the field is in read-only state',
])
--}}
<div class="form-group {{ ($required ?? false) ? 'required' : '' }}">
    <label for="{{ $name }}">{{ $label }}</label>
    @if ($description ?? false)
        <p>{{ $description }}</p>
    @endif
    <select class="selectpicker show-tick form-control" id="{{ $name }}" name="{{ $name }}" title="{{ $placeholder }}" data-live-search="true" {{ ($readonly ?? false) ? 'disabled' : '' }} {{ ($autofocus ?? false) ? 'autofocus' : '' }}>
        @if (!($required ?? false))
            <option value="">--</option>
        @endif
        @foreach ($users as $user)
            <option value="{{ $user->id }}"{{ ($value === $user->id) ? " selected" : "" }} data-content="{!! $user->icon() !!} {{ $user->name }}">{{ $user->name }}</option>
        @endforeach
    </select>
</div>
