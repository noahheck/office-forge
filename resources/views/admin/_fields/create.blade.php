@section('content')

    <div class="row justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h1>
                {!! \App\icon\formFields(['mr-2']) !!}{{ __('admin.newField') }}
            </h1>

            <p class="text-muted">{{ __('admin.newField_shortDescription') }}</p>

            <div class="card document">
                <div class="card-body">

                    @include('admin._fields._form', [
                        'action' => route($fieldStoreRouteName, $fieldStoreRouteParams),
                    ])

                </div>
            </div>

        </div>
    </div>
@endsection
