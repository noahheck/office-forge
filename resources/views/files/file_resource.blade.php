@extends("layouts.app")

@section('content')


    <div class="row file-resource">

        <div class="col-12 col-md-4 col-xl-3 mb-3 no-print">

            <div class="resource-sidebar">

                <div class="file-identifier">

                    <h4 class="h5 text-muted pl-3">{!! $fileType->icon() !!} - {{ $fileType->name }}</h4>

                    <div class="card shadow mb-3">
                        <div class="card-body">
                            <h3>{{ $file->name }}</h3>

                            <hr>

                            <div class="text-center">
                                {!! $file->thumbnail() !!}
                            </div>

                            <hr>

                            <a href="{{ route('files.show', [$file]) }}">
                                {!! \App\icon\goBack(['mr-2']) !!}{{ __('file.backToFileType', ['fileType' => $fileType->name]) }}
                            </a>
                        </div>
                    </div>

                </div>

                @yield('resource-sidebar')

            </div>

        </div>

        <div class="col-12 col-md-8 col-xl-9">

            <div class="row justify-content-center">

                <div class="col-12 col-xl-10 mb-2">

                    @yield('resource-content')

                </div>

            </div>

        </div>

    </div>

@endsection
