@php
$__context = $context ?? false;
@endphp
<div class="form-doc--list-item work-list--list-item @if($formDoc->isSubmitted()) submitted @endif">
    <div class="icon-container">
        <span class="icon">
            {!! \App\icon\formDocs(['fa-fw']) !!}
        </span>
    </div>
    <div class="details-container">
        <div class="form-doc--name">{{ $formDoc->name }}</div>
        <div class="details">
            <div class="doc-details">
                <div>
                    <small>

                        @if ($formDoc->isSubmitted())
                            {{ \App\format_datetime($formDoc->submitted_at) }}
                        @else
                            <strong>{{ __('formDoc.started') }}:</strong> {{ \App\format_datetime($formDoc->created_at) }}
                        @endif
                        @if ($__context !== 'file' && $__file = $formDoc->file)
                            {!! $__file->icon(['ml-2', 'mr-2', 'mhw-25p']) !!}{{ $__file->name }}
                        @endif
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
