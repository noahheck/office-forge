@if ($folders->count() > 0 || $mediaFiles->count() > 0)
    @php
        $listOpened = true;
    @endphp
    <div class="list-group mt-2">
        @endif

        @foreach ($folders as $folder)

            <a class="list-group-item list-group-item-action" href="{{ route('drives.folders.show', [$drive, $folder]) }}">
                {!! \App\icon\folder(['fa-fw', 'mr-2']) !!}{{ $folder->name }}
            </a>

        @endforeach

        @foreach ($mediaFiles as $file)

            <a class="list-group-item list-group-item-action" href="{{ route('drives.files.show', [$drive, $file]) }}">
                {!! $file->icon(['fa-fw', 'mr-2']) !!}{{ $file->name }}
                <small class="text-muted">{{ \App\format_datetime($file->updated_at) }}</small>
            </a>

        @endforeach

        @if ($listOpened ?? false)
    </div>
@endif
