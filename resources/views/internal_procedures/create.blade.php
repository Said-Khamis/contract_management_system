@extends('layouts.master')
@section('title', 'Manage Internal Processes')
@section('content')
    @component('components.breadcrumb')
        @slot('sub_title')
            Internal Processes
        @endslot
        @slot('action')
            Attend
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-sm-7">

            <div class="card" id="internal_procedure">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0">Internal Processes For: {{ $contract->title }}</h5>
                        <div class="flex-shrink-0 mt-2 mt-sm-0">
                            <a href="{{ URL::previous() }}" class="btn btn-outline-secondary btn-sm float-end">
                                <span class="icon-on"><i class="ri-arrow-left-line align-bottom me-1"></i> Back to Details</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="profile-timeline">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            @foreach ($procedures as $index => $procedure)
                                <div class="accordion-item border-0">
                                    <div class="accordion-header" id="heading{{ $index }}">
                                        <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                            href="#collapse{{ $index }}" aria-expanded="true"
                                            aria-controls="collapse{{ $index }}">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 avatar-xs">
                                                    <div class="avatar-title bg-success rounded-circle">
                                                        <i class="ri-shopping-bag-line"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    @if ($procedure->to_institution_id)
                                                        <h6 class="fs-15 mb-0 fw-semibold">
                                                            
                                                            {{ $procedure->toInstitution->name }} <span
                                                                class="fw-normal">{{ date('M d, Y h:iA', strtotime($procedure->created_at)) }}</span>
                                                        </h6>
                                                    @else
                                                        <h6 class="fs-15 mb-0 fw-semibold">{{ $procedure->fromInstitution->name }}
                                                            <span
                                                                class="fw-normal">{{ date('M d, Y h:iA', strtotime($procedure->created_at)) }}</span>
                                                        </h6>
                                                    @endif
                                                </div>
                                            </div>
                                        </a>
                                    </div>
        
                                    @if($procedure->to_institution_id == auth()->user()->institution_id || ($procedure->to_institution_id == null && $procedure->from_institution_id == auth()->user()->institution_id))
        
                                        @foreach ($procedure->procedureComments as $procedureComment)
                                            <div id="collapse{{ $index }}" class="accordion-collapse collapse show"
                                                aria-labelledby="heading{{ $index }}" data-bs-parent="#accordionExample">
                                                <div class="accmordion-body ms-2 ps-5 pt-0">
                                                    @if ($procedureComment->to_user_id)
                                                        <p class="">
                                                            <span class="text-muted">
                                                                DLS ({{ $procedureComment->fromUser->fullName }}) <i
                                                                    class="ri-arrow-right-line align-middle me-1"></i>
                                                                Legal Officer ({{ $procedureComment->toUser->fullName }})
                                                            </span><br>
                                                            {{ $procedureComment->comment }} <br>
        
                                                            {{-- <div class="container"> --}}
                                                                @foreach($procedureComment->attachment as $attachment)
                                                                    <a href="{{ asset('storage/' . $attachment->url) }}" target="_blank" class="btn btn-outline-secondary">
                                                                        {{-- <i class="fa fa-pdf-o"></i> --}}
                                                                        {{-- <i class="fas fa-file-pdf"></i> --}}
                                                                        {{ $attachment->name }}
                                                                    </a><br>
                                                                    {{-- <iframe src="{{ asset('storage/app/'.$attachment->url) }}" width="100%" height="500"></iframe> --}}
                                                                @endforeach
                                                            {{-- </div> --}}
        
                                                            <span class="text-muted">
                                                                {{ date('M d, Y h:iA', strtotime($procedureComment->created_at)) }}
                                                            </span>
                                                        </p>
                                                    @else
                                                        <p class="">
                                                            <span class="text-muted">
                                                                DLS ({{ $procedureComment->fromUser->fullName }})
                                                            </span><br>
                                                            {{ $procedureComment->comment }} <br>
                                                            <span class="text-muted">
                                                                {{ date('M d, Y h:iA', strtotime($procedureComment->created_at)) }}
                                                            </span>
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @else

                                        @foreach ($procedure->procedureComments as $procedureComment)
                                            <div id="collapse{{ $index }}" class="accordion-collapse collapse show"
                                                aria-labelledby="heading{{ $index }}" data-bs-parent="#accordionExample">
                                                <div class="accmordion-body ms-2 ps-5 pt-0">
                                                    @if ($procedureComment->to_user_id)
                                                        <p class="">
                                                            <span class="text-muted">
                                                                DLS ({{ $procedureComment->fromUser->fullName }}) <i
                                                                    class="ri-arrow-right-line align-middle me-1"></i>
                                                                Legal Officer ({{ $procedureComment->toUser->fullName }})
                                                            </span><br>
                                                            
                                                            {{-- No message --}}

                                                            <span class="text-muted">
                                                                {{ date('M d, Y h:iA', strtotime($procedureComment->created_at)) }}
                                                            </span>
                                                        </p>
                                                    @else
                                                        <p class="">
                                                            <span class="text-muted">
                                                                DLS ({{ $procedureComment->fromUser->fullName }})
                                                            </span><br>
                                                            {{ $procedureComment->comment }} <br>
                                                            <span class="text-muted">
                                                                {{ date('M d, Y h:iA', strtotime($procedureComment->created_at)) }}
                                                            </span>
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                            @break
                                        @endforeach
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-5">
            <div class="content">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Attend</h4>
                    </div>

                    {!! Form::open(['route' => ['internal-procedures.create-for-contract', encode($contract->id)], 'method' => 'post', 'files'=>true]) !!}

                    <div class="card-body">
                        <div class="row">
                            @include('internal_procedures.fields')
                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <a href="{{ URL::previous() }}" class="btn btn-default">Cancel</a>
                        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection