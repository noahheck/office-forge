<form action="{{ $action }}" method="POST" class="bold-labels">
    @csrf

    @if($method ?? false)
        @method($method)
    @endif

    @if ($fileType = $drive->fileType)

        <h4>{!! $fileType->icon(['mr-2']) !!}{{ $fileType->name }}</h4>

        <hr>

        @hiddenField([
            'name' => 'file_type_id',
            'value' => $drive->file_type_id,
        ])

    @endif

    @hiddenField([
        'name' => 'return',
        'value' => old('return', url()->previous()),
    ])

    <div class="row">

        <div class="col-12">

            <ul class="nav nav-tabs mb-2" id="formDocsNavTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="detailsTab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">{{ __('fileStore.drive_details') }}</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="accessTab" data-toggle="tab" href="#access" role="tab" aria-controls="access">{{ __('fileStore.drive_teamAccessApproval') }}</a>
                </li>
            </ul>

            <div class="tab-content" id="formDocsContent">

                <div class="tab-pane show active" id="details" role="tabpanel" aria-labelledby="detailsTab">

                    @errors('name', 'active', 'teams')

                    @textField([
                        'name' => 'name',
                        'label' => __('fileStore.drive_name'),
                        'value' => old('name', $drive->name),
                        'placeholder' => __('fileStore.drive_nameExamples'),
                        'required' => true,
                        'autofocus' => true,
                        'error' => $errors->has('name'),
                    ])

                    @textareaField([
                        'name' => 'description',
                        'label' => __('fileStore.drive_description'),
                        'details' => '',
                        'value' => old('description', $drive->description),
                        'placeholder' => __('fileStore.drive_descriptionExamples'),
                        'rows' => '3',
                        'required' => false,
                        'autofocus' => false,
                        'error' => $errors->has('description'),
                        'readonly' => false,
                    ])

                </div>

                <div class="tab-pane" id="access" role="tabpanel" aria-labelledby="accessTab">

                    @label([
                        'for' => '',
                        'label' => __('fileStore.drive_teamAccessApproval'),
                    ])

                    <p class="br-spacers">{!! nl2br(e(__('fileStore.drive_teamAccessApprovalDescription'))) !!}</p>

                    <hr>

                    <div class="table-responsive">

                        <table id="teams" class="table table-sm table-striped table-bordered dt-table" data-columns='[{"orderable": false}, {"orderable": false}, null, null]'>

                            <thead>
                            <tr>
                                <th class="w-50p text-center">{{ __('fileStore.drive_teamAccessView') }}</th>
                                <th class="w-50p text-center">{{ __('fileStore.drive_teamAccessEdit') }}</th>
                                <th>{{ __('app.team') }}</th>
                                <th>{{ __('app.members') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teamOptions as $team)
                                <tr>
                                    <td class="w-50p text-center">
                                        @checkboxSwitchField([
                                            'name' => 'viewers[]',
                                            'id' => 'viewers_' . $team->id,
                                            'label' => '',
                                            'details' => '',
                                            'checked' => $drive->viewingTeams->contains($team),
                                            'value' => $team->id,
                                            'required' => false,
                                            'error' => false,
                                        ])
                                    </td>
                                    <td class="w-50p text-center">
                                        @checkboxSwitchField([
                                            'name' => 'editors[]',
                                            'id' => 'editors_' . $team->id,
                                            'label' => '',
                                            'details' => '',
                                            'checked' => $drive->editingTeams->contains($team),
                                            'value' => $team->id,
                                            'required' => false,
                                            'error' => false,
                                        ])
                                    </td>
                                    <td>{!! $team->icon() !!} {{ $team->name }}</td>
                                    <td>
                                        @foreach($team->members as $member)
                                            {!! $member->icon(['mr-2']) !!}
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>

                    </div>









                </div>

            </div>

        </div>

    </div>

    <hr>

    <button type="submit" class="btn btn-primary">
        {{ __('app.save') }}
    </button>

    <a class="btn btn-secondary" href="{{ url()->previous(route('admin.drives.index')) }}">
        {{ __('app.cancel') }}
    </a>

</form>
