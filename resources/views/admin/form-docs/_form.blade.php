<form action="{{ $action }}" method="POST" class="bold-labels">
    @csrf

    @if($method ?? false)
        @method($method)
    @endif


    <div class="row">

        <div class="col-12">

            <ul class="nav nav-tabs mb-2" id="formDocsNavTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="detailsTab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">{{ __('formDoc.details') }}</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="accessTab" data-toggle="tab" href="#access" role="tab" aria-controls="access">{{ __('formDoc.teamAccessApproval') }}</a>
                </li>
            </ul>

            <div class="tab-content" id="formDocsContent">

                <div class="tab-pane show active" id="details" role="tabpanel" aria-labelledby="detailsTab">

                    @if ($canSelectFileType)

                        @fileTypeSelectField([
                            'name' => 'file_type_id',
                            'label' => __('app.fileType'),
                            'value' => $template->file_type_id,
                            'fileTypes' => $fileTypeSelectOptions,
                            'placeholder' => '',
                            'description' => '',
                            'required' => false,
                            'autofocus' => true,
                            'error' => $errors->has('file_type_id'),
                        ])

                    @elseif ($fileType = $template->fileType)
                        <h5>{!! $fileType->iconAndName() !!}</h5>

                        @hiddenField([
                            'name' => 'file_type_id',
                            'value' => $fileType->id,
                        ])

                        <hr>
                    @endif


                    @errors('name', 'active', 'teams')

                    @textField([
                        'name' => 'name',
                        'label' => __('file.formDoc_name'),
                        'value' => old('name', $template->name),
                        'placeholder' => __('formDoc.nameExamples'),
                        'required' => true,
                        'autofocus' => true,
                        'error' => $errors->has('name'),
                    ])

                    @if ($showActive ?? false)

                        <hr>

                        @checkboxSwitchField([
                            'name' => 'active',
                            'id' => 'formDoc_active',
                            'label' => __('formDoc.active'),
                            'details' => __('formDoc.activeDescription'),
                            'checked' => old('active', $template->active),
                            'value' => '1',
                            'required' => false,
                            'error' => $errors->has('active'),
                        ])

                    @endif

                </div>

                <div class="tab-pane" id="access" role="tabpanel" aria-labelledby="accessTab">

                    @label([
                        'for' => '',
                        'label' => __('formDoc.teamAccessApproval'),
                    ])

                    <p class="br-spacers">{!! nl2br(e(__('formDoc.teamAccessApprovalDescription'))) !!}</p>

                    <hr>

                    <div class="table-responsive">

                        <table id="teams" class="table table-sm table-striped table-bordered dt-table" data-columns='[{"orderable": false}, {"orderable": false}, null, null]'>

                            <thead>
                                <tr>
                                    <th class="w-50p text-center">{{ __('formDoc.create') }}</th>
                                    <th class="w-50p text-center">{{ __('formDoc.review') }}</th>
                                    <th>{{ __('app.team') }}</th>
                                    <th>{{ __('app.members') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($teamOptions as $team)
                                    <tr>
                                        <td class="w-50p text-center">
                                            @checkboxSwitchField([
                                                'name' => 'creators[]',
                                                'id' => 'creators_' . $team->id,
                                                'label' => '',
                                                'details' => '',
                                                'checked' => $template->creatingTeams->contains($team),
                                                'value' => $team->id,
                                                'required' => false,
                                                'error' => false,
                                            ])
                                        </td>
                                        <td class="w-50p text-center">
                                            @checkboxSwitchField([
                                                'name' => 'reviewers[]',
                                                'id' => 'reviewers_' . $team->id,
                                                'label' => '',
                                                'details' => '',
                                                'checked' => $template->reviewingTeams->contains($team),
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

    <a class="btn btn-secondary" href="{{ url()->previous(route('admin.form-docs.index')) }}">
        {{ __('app.cancel') }}
    </a>

</form>
