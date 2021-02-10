<div class="col-12 col-md-6">
    <div class="card">
        <div class="card-header">
            {{ $visualization->label }}
        </div>
        <div class="card-body text-center">
            <span class="display-3">
                {{ $resultSet->records()->count() }}
            </span>
        </div>
    </div>
</div>
