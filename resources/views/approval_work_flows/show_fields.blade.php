<div class="container-fluid">
    <table class="table table-striped table-bordered" id="employees" >
        <tbody>
           <tr>
              <!-- Id Field -->
              <div class="form-group">
                  <td>{!! Form::label('id', 'AppWorkFlow ID') !!}</td><td>{!! $approvalWorkFlow->id !!}</td>
              </div>
           </tr>

           <tr>
              <!-- Created At Field -->
              <div class="form-group">
                  <td>{!! Form::label('created_at', 'Created At') !!}</td><td>{!! $approvalWorkFlow->created_at !!}</td>
              </div>
           </tr>

           <tr>
              <!-- Updated At Field -->
              <div class="form-group">
                  <td>{!! Form::label('updated_at', 'Updated At') !!}</td><td>{!! $approvalWorkFlow->updated_at !!}</td>
              </div>
           </tr>

           <tr>
              <!-- Name Field -->
              <div class="form-group">
                  <td>{!! Form::label('name', 'AppWorkFlow Name') !!}</td><td>{!! $approvalWorkFlow->name !!}</td>
              </div>
           </tr>

           <tr>
              <!-- Type Field -->
              <div class="form-group">
                  <td>{!! Form::label('name', 'AppWorkFlow Type') !!}</td><td>{!! $approvalWorkFlow->name !!}</td>
              </div>
           </tr>

           <tr>
              <!-- Rank Field -->
              <div class="form-group">
                  <td>{!! Form::label('rank', 'AppWorkFlow Rank') !!}</td><td>{!! $approvalWorkFlow->rank !!}</td>
              </div>
           </tr>

           <tr>
              <!-- Is Enabled Field -->
              <div class="form-group">
                  <td>{!! Form::label('is_enabled', 'Is Enabled') !!}</td><td>{!! $approvalWorkFlow->is_enabled !!}</td>
              </div>
           </tr>

           <tr>
              <!-- Is Auto Approve Field -->
              <div class="form-group">
                  <td>{!! Form::label('is_auto_approve', 'Is Auto Approve') !!}</td><td>{!! $approvalWorkFlow->is_auto_approve !!}</td>
              </div>
           </tr>

           <tr>
              <!-- Description Field -->
              <div class="form-group">
                  <td>{!! Form::label('description', 'Description') !!}</td><td>{!! $approvalWorkFlow->description !!}</td>
              </div>
           </tr>

           <tr>
              <!-- Created By Field -->
              <div class="form-group">
                  <td>{!! Form::label('created_by', 'Created By') !!} </td><td>{!! $approvalWorkFlow->created_by !!}</td>
              </div>
           </tr>

           <tr>
              <!-- Updated By Field -->
              <div class="form-group">
                  <td>{!! Form::label('updated_by', 'Updated By') !!} </td><td>{!! $approvalWorkFlow->updated_by !!}</td>
              </div>
           </tr>

           <tr>
              <!-- Approval Id Field -->
              <div class="form-group">
                  <td>{!! Form::label('approval_id', 'Approval ID') !!}</td><td>{!! $approvalWorkFlow->approval_id !!}</td>
              </div>
           </tr>
        </tbody>
    </table>
</div>
