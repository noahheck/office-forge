{{--

--}}
<h2>{!! \App\icon\reports(['mr-2']) !!}{{ $compiledReport->name }}</h2>

<hr>

<div class="editor-content mb-3">
    {!! \App\safe_text_editor_content($compiledReport->description) !!}
</div>

@foreach ($compiledReport->resultSets() as $resultSet)

    @if (!$loop->first)
        <hr>
    @endif

    @include('reports._resultSet', [
        'compiledReport' => $compiledReport,
        'resultSet' => $resultSet,
    ])

@endforeach
