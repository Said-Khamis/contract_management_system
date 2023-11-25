@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Approval Group
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($approvalGroup, ['route' => ['approvalGroups.update', $approvalGroup->id], 'method' => 'patch']) !!}

                        @include('approval_groups.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection