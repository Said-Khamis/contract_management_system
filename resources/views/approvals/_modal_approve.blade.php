<!-- Modal -->
@php
    $approval = $goodRequisition->approval;
@endphp
@isset($approval)
<div class="modal fade" id="approve{{$approval->id}}" tabindex="-1" role="dialog" aria-labelledby="approveLabel">
    <div class="modal-dialog" role="document">
        {!! Form::model($approval,['route' =>['approvals.approve',$approval->id], 'method' => 'POST']) !!}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title text-capitalize" id="approveLabel">Approve {{$approval->approvalable_type}}</h5>
            </div>
            <div class="modal-body">


                <input type="hidden" name="_token" value="{{csrf_token()}}" class="form-control"
                       required="required">

                <!-- Current Approval Flow Id Field -->
                <div class="form-group " style="width: 100%;">
                    {!! Form::label('action', 'Action:') !!}
                    {!! Form::select('action', [''=>'select action',
                    'approve' => 'approve', 'reject' => 'reject'], null,
                    ['class' => 'form-control general-select2','style'=>'width:100%']) !!}
                </div>

                <label>Comment</label>
                <textarea name="comment" style="width: 100%" rows="2" class="form-control"
                          required="required"></textarea>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel
                </button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
      {!! Form::close() !!}
    </div>
</div>
<!--end Modal -->
@endisset

