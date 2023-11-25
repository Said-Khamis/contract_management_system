@extends('layouts.master')
@section('title', 'Manage Contracts')
@section('content')
    @component('components.breadcrumb')
        @slot('sub_title')
            Agreements
        @endslot
        @slot('action')
            Create
        @endslot
    @endcomponent
    <div class="content">
        <div class="card">
            <div class="card-header">
                <a href="#" class="btn btn-primary float-lg-end" onClick="window.history.back();"><i class=" bx bx-arrow-back text-green"></i>Back</a>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <table class="table table-sm table-bordered align-middle mb-0">
                            <thead>
                            <tr class="bg-label-primary" style="font-size: 1.5em;letter-spacing: 2px;font-family: sans-serif, Verdana">
                                <th colspan="4" class="text-lg-center">
                                    <div>
                                        {{ucwords($contract->type)}}
                                    </div>
                                    <div>
                                        Between
                                    </div>
                                    <div>
                                        {{ucwords($contract->contractParties()->where('is_local',0)->first()->institution->name)}}
                                    </div>
                                    <div>
                                        And
                                    </div>
                                    <div>
                                        {{ucwords($contract->contractParties()->where('is_local',1)->first()->institution->name)}}
                                    </div>
                                    <div>
                                        On the
                                    </div>
                                    <div>
                                        {{ucwords($contract->title)}}
                                    </div>
                                </th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Agreement Attachments
            </div>
            <div class="card-body">
                <table class="table">
                <thead>
                <tr style="color: black;font-weight: bolder">
                    <th>Name</th>
                    <th width="80px" class="text-lg-center">File</th>
                </tr>
                </thead>
                <tbody>
                @foreach($contract->attachments as $attachment)
                    <tr>
                        <td>
                            {{ucwords(strtolower($attachment->name))}}
                        </td>
                        <td width="80px" class="text-lg-center">
                            <a href="#" class="btn btn-sm btn-warning btn-xs"
                               data-bs-toggle="modal" data-bs-target="#account_Attachment{{$attachment->id}}">
                                <i class="tf-icons bx bx-file me-1"></i>
                            </a>
                        </td>
                    </tr>
                    <!-- modal section -->
                    <div class="modal fade" id="account_Attachment{{$attachment->id}}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="varyingContentModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{$attachment->name}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <iframe style="width: 100%;height: 600px;" src="{{\Illuminate\Support\Facades\Storage::url($attachment->url)}}" title="Attachment"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Agreement Objectives
                <a class="btn btn-primary btn-sm float-end" href="{{route('contractObjectives.create')}}">+</a>
            </div>
            <table>
                <tbody>
                <ol>
                    @foreach ($contract->contractObjectives as $objective)
                        @if ($objective->contract_objective_id === null)
                            <li class="mt-1">
                                {{ $objective->details }}
                                <hr>
                                <ul class="">
                                    @foreach ($contract->contractObjectives as $childObjective)
                                        @if ($childObjective->contract_objective_id === $objective->id)
                                            <li class="">
                                                {{ $childObjective->details }}
                                                <div class='btn-group'>
                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-fill align-middle"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <button class="dropdown-item edit-item-btn data-modal" data-url="{{ route('contractObjectives.show', [$childObjective->id]) }}">
                                                                <i class="ri-pencil-fill align-bottom me-2 text-muted">
                                                                </i> Show
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button class="dropdown-item edit-item-btn data-modal" data-url="{{ route('contractObjectives.edit', [$childObjective->id]) }}">
                                                                <i class="ri-pencil-fill align-bottom me-2 text-muted">
                                                                </i> Edit
                                                            </button>
                                                        </li>
                                                        <li>
                                                            {!! Form::open(['route' => ['contractObjectives.destroy', $childObjective->id], 'method' => 'delete']) !!}
                                                            {!! Form::button('<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete', ['type' => 'submit', 'class' => 'dropdown-item edit-item-btn', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                                            {!! Form::close() !!}
                                                        </li>
                                                    </ul>

                                                </div>
                                                <hr>
                                                @include('contract_objectives.nested_objectives', ['contractObjectives' => $contract->contractObjectives, 'parentId' => $childObjective->id])
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @endforeach
                </ol>
                </tbody>
            </table>
        </div>

        @include('contracts._responsibilities')
        @include('contracts._cooperation_area')
    </div>
@endsection
