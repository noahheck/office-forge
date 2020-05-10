@extends("layouts.app")

@push('styles')
{{--    @style('css/activities.css')--}}
@endpush

@include("_component._location-bar", [
    'locationBar' => (new \App\Navigation\LocationBar\FormDocs\Index),
])

@section('content')

    @if ($templates->count() > 0)
        <div class="float-right">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    {!! \App\icon\circlePlus(['mr-1']) !!}{{ __('formDoc.newFormDoc') }}
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    @foreach ($templates as $template)
                        <a class="dropdown-item" href="{{ route('form-docs.create', ['form_doc_template_id' => $template]) }}">
                            {{ $template->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <h1>
        {!! \App\icon\formDocs(['mr-2']) !!}{{ __('app.formDocs') }}
    </h1>


    <div class="card shadow">
        <div class="card-body">

            @forelse($formDocs as $formDoc)

                @if($loop->first)

                    <div class="table-responsive">
                        <table id="projects" class="projects table table-striped table-bordered dt-table">
                            <thead>
                                <tr>
                                    <th class="w-50p">{{ __('formDoc.publicationDate') }}</th>
                                    <th>{{ __('formDoc.name') }}</th>
                                    <th class="w-100p">{{ __('formDoc.creator') }}</th>
                                    <th class="w-100p">{{ __('app.file') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                @endif

                <tr>
                    <td data-sort="{{ $formDoc->published_at }}">
                        {{ App\format_date($formDoc->published_at) }}
                    </td>
                    <td data-sort="{{ $formDoc->name }}">
                        <a href="{{ route('form-docs.show', [$formDoc]) }}">
                            {{ $formDoc->name }}</a>
                    </td>
                    <td data-sort="{{ $formDoc->creator->name }}">
                        {!! $formDoc->creator->iconAndName() !!}
                    </td>
                    @if ($formDoc->file_id && $__file = $formDoc->file)
                        <td data-sort="{{ $__file->name }}">
                                {!! $__file->icon() !!}
                                <a href="{{ route('files.show', [$__file->id]) }}">{{ $__file->name }}</a>
                        </td>
                    @else
                        <td data-sort="">
                            &nbsp;
                        </td>
                    @endif
                </tr>

                @if($loop->last)
                            </tbody>
                        </table>
                    </div>
                @endif

            @empty

                <div class="empty-resource border p-3">
                    {!! \App\icon\formDocs(['empty-resource-icon']) !!}
                    <p>{{ __('admin.formDoc_description') }}</p>
                </div>

            @endforelse

        </div>
    </div>
@endsection
