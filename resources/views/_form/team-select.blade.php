{{--
@teamSelectField([
    'name' => 'string: form field name',
    'label' => 'string: text label for form field',
    'value' => 'string: the field's value',
    'multiple' => 'boolean: whether the field allows selecting multiple values',
    'teams' => 'Collection of teams to display in the field',
    'placeholder' => 'string: example placeholder text',
    'description' => 'string: additional details describing this field',
    'required' => 'boolean: whether the field is required',
    'autofocus' => 'boolean: whether the field should be focused on load',
    'error' => 'boolean: whether the field is in error state',
])
--}}
<div class="form-group {{ ($required ?? false) ? 'required' : '' }}">
    <label for="{{ $name }}">{{ $label }}</label>
    @if ($description ?? false)
        <p>{{ $description }}</p>
    @endif
    <select class="selectpicker show-tick form-control" id="{{ $name }}" name="{{ $name }}{{ ($multiple || false) ? '[]' : '' }}" title="{{ $placeholder }}" data-live-search="true" {{ ($multiple ?? false) ? 'multiple' : '' }}>
        @if (!($required ?? false))
            <option value="">--</option>
        @endif
        @foreach ($teams as $team)
            <option value="{{ $team->id }}"{{ ($value === $team->id) ? " selected" : "" }} data-content="{!! $team->icon() !!} {{ $team->name }}">{{ $team->name }}</option>
        @endforeach
    </select>
</div>
