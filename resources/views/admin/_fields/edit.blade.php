@section('content')

    <div class="row justify-content-center document-print-container">

        <div class="col-12 col-md-10 document-container">

            <h1>
                {!! \App\icon\formFields(['mr-2']) !!}{{ __('admin.editField') }}
            </h1>

            <p class="text-muted">{{ __('admin.editField_shortDescription') }}</p>

            <div class="card document">
                <div class="card-body">

                    @include('admin._fields._form', [
                        'action' => route($fieldUpdateRouteName, $fieldUpdateRouteParams),
                        'method' => 'PUT',
                        'showActive' => true,
                    ])

                </div>
            </div>

        </div>
    </div>

@endsection
