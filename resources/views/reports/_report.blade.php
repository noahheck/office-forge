{{--

--}}
<h2>{!! \App\icon\reports(['mr-2']) !!}{{ $report->name }}</h2>

<hr>

<div class="editor-content mb-3">
    {!! \App\safe_text_editor_content($report->description) !!}
</div>

@foreach ($report->datasets as $dataset)
    @if(!$loop->first)
        <hr>
    @endif

    @include('reports._dataset', [
        'report' => $report,
        'dataset' => $dataset,
    ])
@endforeach
