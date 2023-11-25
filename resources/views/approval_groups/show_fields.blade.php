<div class="container-fluid">
    <table class="table table-striped table-bordered" id="employees" >
        <tbody>
        <tr>
            <!-- Id Field -->
            <div class="form-group">
                <td>{!! Form::label('id', 'Approval ID') !!}</td><td>{!! $approvalGroup->id !!}</td>
            </div>
        </tr>
        <tr>
            <!-- Created At Field -->
            <div class="form-group">
                <td>{!! Form::label('created_at', 'Created At') !!}</td><td>{!! $approvalGroup->created_at !!}</td>
            </div>
        </tr>
        <tr>
            <!-- Updated At Field -->
            <div class="form-group">
                <td>{!! Form::label('updated_at', 'Updated At') !!}</td><td>{!! $approvalGroup->updated_at !!}</td>
            </div>
        </tr>
        <tr>
            <!-- Name Field -->
            <div class="form-group">
                <td>{!! Form::label('name', 'Group Name') !!}</td><td>{!! $approvalGroup->name !!}</td>
            </div>
        <tr>
            <!-- Rank Field -->
            <div class="form-group">
                <td>{!! Form::label('rank', 'Rank') !!}</td><td>{!! $approvalGroup->rank !!}</td>
            </div>
        </tr>
        <tr>
            <!-- Description Field -->
            <div class="form-group">
                <td>{!! Form::label('description', 'Description') !!}</td><td>{!! $approvalGroup->description !!}</td>
            </div>
        </tr>
        <tr>
            <!-- Created By Field -->
            <div class="form-group">
                <td>{!! Form::label('created_by', 'Created By') !!}</td><td>{!! $approvalGroup->created_by !!}</td>
            </div>
        </tr>
        <tr>
            <!-- Updated By Field -->
            <div class="form-group">
                <td>{!! Form::label('updated_by', 'Updated By') !!}</td><td>{!! $approvalGroup->updated_by !!}</td>
            </div>
        </tr>
        </tbody>
    </table>
</div>
