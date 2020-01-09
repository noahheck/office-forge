@section('location-bar')
    <div class="location-bar" aria-label="breadcrumb">
        <ul>
            @foreach ($locationBar->getPath() as $link)

                <li>
                    @if (!$loop->first)
                        <span class="fas fa-angle-right separator"></span>
                    @endif

                    @if ($link['href'] ?? false)
                        <a href="{{ $link['href'] }}"@if ($loop->first) class="no-text-decoration"@endif>
                            @if ($link['icon'] ?? false) <span class="{{ $link['icon'] }} no-text-decoration"></span> @endif
                            {{ $link['text'] }}</a>
                    @else
                        @if ($link['icon'] ?? false) <span class="{{ $link['icon'] }}"></span> @endif
                        {{ $link['text'] }}
                    @endif
                </li>
            @endforeach

            {{-- Last item in the list, if one is set for the location bar --}}
            @if ($__currentLocation = $locationBar->getCurrentLocation())
                <li aria-current="page">
                    <span class="fas fa-angle-right separator"></span>
                    {{ $__currentLocation }}
                </li>
            @endif
        </ul>
    </div>
@endsection
