<a class="{{Request::segment(4) == 0 ? ' p-2 bg-red text-white ' : ''}}" style="margin-top: -10px;margin-bottom: 5px"
   href="{!! route('approvals.filter',0) !!}">
    <span class="flat-icon icon-list"></span>
    <span> All Approvals &nbsp;</span>
</a>

<a class="{{Request::segment(4) == 2 ? ' p-2 bg-red text-white ' : ''}}" style="margin-top: -10px;margin-bottom: 5px"
   href="{!! route('approvals.filter',2) !!}">
    <span class="flat-icon icon-unlocked"></span>
    <span> Approved &nbsp;</span>
</a>
<a class="{{Request::segment(4) == 1 ? ' p-2 bg-red text-white ' : ''}}" style="margin-top: -10px;margin-bottom: 5px"
   href="{!! route('approvals.filter',1) !!}">
    <span class="flat-icon icon-hourglass"></span>
    <span> Need Approval  &nbsp;</span>
</a>





