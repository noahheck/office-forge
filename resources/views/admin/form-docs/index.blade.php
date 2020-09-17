@extends("layouts.admin")

@include("_component._location-bar", [
    'locationBar' => new \App\Navigation\LocationBar\Admin\FormDocs\Index(),
])

@section('content')
    <h1>
        {!! \App\icon\formDocs(['mr-2']) !!}{{ __('app.formDocs') }}
    </h1>


    @if (count($templates) > 0)
        <div class="card">
            <div class="card-body">
                <div class="text-right">
                    <a href="{{ route('admin.form-docs.create') }}" class="btn btn-primary">
                        {!! \App\icon\circlePlus(['mr-1']) !!}{{ __('admin.newFormDoc') }}
                    </a>
                </div>
                <hr>
                <div class="table-responsive">
                    <table id="formDocs" class="table table-striped table-bordered dt-table" data-order='[[ 0, "asc" ]]'>
                        <thead>
                            <tr>
                                <th>{{ __('formDoc.name') }}</th>
                                <th class="w-100p">{{ __('app.fileType') }}</th>
                                <th class="w-50p">{{ __('formDoc.active') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($templates as $template)
                                <tr>
                                    <td data-sort="{{ $template->name }}" data-search="{{ $template->name }}">
                                        <a href="{{ route('admin.form-docs.show', [$template]) }}">
                                            {{ $template->name }}
                                        </a>
                                    </td>
                                    @if ($__fileType = $template->fileType)
                                        <td data-sort="{{ $__fileType->name }}">
                                            {!! $__fileType->icon() !!}&nbsp;{{ $__fileType->name }}
                                        </td>
                                    @else
                                        <td data-sort="">

                                        </td>
                                    @endif
                                    <td class="text-center" data-order="{{ $template->active ? '1' : '0' }}">
                                        @if ($template->active)
                                            {!! \App\icon\checkedBox() !!}
                                        @else
                                            {!! \App\icon\uncheckedBox() !!}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="row justify-content-center">

            <div class="col-12 col-md-6 col-lg-6 col-xl-5">

                <div class="card">
                    <div class="card-body text-center">

                        <div class="empty-resource">
                            {!! \App\icon\formDocs(['empty-resource-icon']) !!}
                        </div>

                        <p>{{ __('admin.formDoc_description') }}</p>

                        <hr>

                        <a class="btn btn-primary" href="{{ route('admin.form-docs.create') }}">{{ __('admin.formDoc_createFirstFormDocNow') }}</a>
                    </div>
                </div>

            </div>

        </div>
    @endif
@endsection
