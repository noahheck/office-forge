@section('location-bar')
    <div class="location-bar">
        <ul>
            @foreach ($locationBar->getPath() as $link)

                <li>
                    @if (!$loop->first)
                        <strong>&gt;</strong>
                    @endif

                    @if ($link['href'] ?? false)
                        <a href="{{ $link['href'] }}">
                    @endif
                        @if ($link['icon'] ?? false) <span class="{{ $link['icon'] }}"></span> @endif
                        {{ $link['text'] }}
                    @if ($link['href'] ?? false)
                        </a>
                    @endif
                </li>
            @endforeach

            @if ($__currentLocation = $locationBar->getCurrentLocation())
                <li>
                    <strong>&gt;</strong>
                    {{ $__currentLocation }}
                </li>
            @endif
        </ul>
    </div>
@endsection
