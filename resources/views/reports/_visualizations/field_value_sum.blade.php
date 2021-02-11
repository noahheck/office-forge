<div class="col-12 col-md-6">
    <div class="card mb-3">
        <div class="card-header">
            {{ $visualization->label }}
        </div>
        <div class="card-body text-center">
            <span class="display-3">
                {{ $resultSet->records()->sum(function($record) use ($visualization) {
                        return $record->fields()->firstWhere('datasetFieldId', $visualization->field_id)->label;
                    })
                }}
            </span>
        </div>
    </div>
</div>
