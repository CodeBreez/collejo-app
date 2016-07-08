<div class="col-xs-6 term-block" id="term-{{ $term->id }}">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-3"><label>Name</label></div>
                <div class="col-xs-9">{{ $term->name }}</div>
            </div>
            <div class="row">
                <div class="col-xs-3"><label>Start Date</label></div>
                <div class="col-xs-9">{{ $term->start_date }}</div>
            </div>
            <div class="row">
                <div class="col-xs-3"><label>End Date</label></div>
                <div class="col-xs-9">{{ $term->end_date }}</div>
            </div>
        </div>
        <div class="panel-footer">
            <span class="label"> </span>
            <div class="tools-footer">
                <a data-toggle="ajax-modal" data-modal-backdrop="static" data-modal-keyboard="false" href="{{ route('batch.term.edit', [$batch->id, $term->id]) }}" class="btn btn-xs btn-default pull-left"><i class="fa fa-edit"></i> Edit</a>
                <a data-success-callback="afterDeleteTerm" data-toggle="ajax-link" data-confirm="Delete this?" href="{{ route('batch.term.delete', [$batch->id, $term->id]) }}" class="btn btn-xs btn-danger pull-left"><i class="fa fa-trash"></i> Delete</a>
            </div>
        </div>
    </div>
</div>