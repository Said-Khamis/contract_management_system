@extends('layouts.app')

@section('content')
   <div class="content">
       <div class="card">
           <div class="card-header">
               Edit {{$approvalWorkFlow->name}}
           </div>
           <div class="card-body">
               {!! Form::model($approvalWorkFlow, ['route' => ['approvalWorkFlows.update', $approvalWorkFlow->id], 'method' => 'patch']) !!}
                <div class="row">
                    <div class="col">
                        @include('approval_work_flows.fields')
                    </div>
                    <div class="col">
                        <label>Active Status</label>
                        <hr class="my-2">
                        @if($approvalWorkFlow->is_enabled)
                            <input type="radio" name="is_enabled" value="0"> Disable<br>
                            <input type="radio" name="is_enabled" value="1" checked> Enabled<br>
                        @else
                            <input type="radio" name="is_enabled" value="0" checked> Disabled<br>
                            <input type="radio" name="is_enabled" value="1"> Enable<br>
                        @endif
                        <br>
                        <label>Is Auto Approval</label>
                        <hr class="my-2">
                        @if($approvalWorkFlow->is_auto_approve)
                            <input type="radio" name="is_auto_approve" value="0"> Manual Approval<br>
                            <input type="radio" name="is_auto_approve" value="1" checked> Auto Approval<br>
                        @else
                            <input type="radio" name="is_auto_approve" value="0" checked> Manual Approval<br>
                            <input type="radio" name="is_auto_approve" value="1"> Auto Approval
                        @endif
                    </div>
                </div>
               {!! Form::close() !!}
           </div>
       </div>
   </div>
@endsection
