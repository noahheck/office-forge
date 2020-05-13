@php
$__context = $context ?? false;
@endphp
<div class="form-doc--list-item @if($formDoc->isSubmitted()) submitted @endif">
    <div class="icon-container">
        <span class="icon">
            {!! \App\icon\formDocs(['fa-fw']) !!}
        </span>
    </div>
    <div class="details-container">
        <div class="form-doc--name">{{ $formDoc->name }}</div>
        <div class="details">
            <div class="doc-details">
                @if ($formDoc->isSubmitted())
                    <div>{{ \App\format_datetime($formDoc->submitted_at) }}</div>
                @endif
                @if ($__context !== 'file' && $__file = $formDoc->file)
                        <div>{!! $__file->icon(['mr-2', 'mhw-25p']) !!}{{ $__file->name }}</div>
                @endif
            </div>
            <div class="creator">
                <span>{!! $formDoc->creator->icon(['mr-2', 'mhw-25p']) !!}{{ $formDoc->creator->name }}</span>
            </div>
        </div>
    </div>
</div>
