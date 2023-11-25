<div class="">
    <table class="table" id="actionPlans-table">
        <thead>
        <tr>
        <th>Name</th>
       <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>


        @foreach($contractActionPlans as $actionPlan)
            @php
                $attachments = App\Models\Attachment::where('attachable_id', $actionPlan->id)->first();
            @endphp
            <tr>
                <td>
                    <a style="color: blue;margin-right: 2em" href="#" title="View {{ucwords(str_replace("_", " ", $attachments->url))}} File" class=""
                       data-bs-toggle="modal" data-bs-target="#attachment{{$attachments->id}}">
                        <i class="ri-file-pdf-fill align-bottom me-2 text-muted">
                        </i>
{{--                        {{ucwords(str_replace("_", " ", $attachments->name))}}--}}
                    </a>
                    <!-- modal section -->
                    <div class="modal fade" id="attachment{{$attachments->id}}" data-bs-backdrop="static" tabindex="-1"
                         aria-labelledby="varyingContentModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{$attachments->name}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <iframe style="width: 100%;height: 600px;" src="{{ asset('storage/action_plan/'.$attachments->name) }}" title="Attachment"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td width="80" style="align-items: center;">
                    <div class='btn-group'>
                        <button type="button" class="btn btn-soft-success btn-sm data-modal"
                                data-url="{{ route('contractActionPlans.show', [$actionPlan->id]) }}"><i
                                class="ri-eye-fill"></i></button>
{{--                        <button type="button" class="btn btn-soft-secondary btn-sm data-modal"--}}
{{--                                data-url="{{ route('contractActionPlans.edit', [$actionPlan->id]) }}"><i class="ri-edit-fill"></i></button>--}}
                        <form action="{{route('contractActionPlans.destroy',$actionPlan->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-soft-danger btn-sm" ><i class="ri-delete-bin-fill"></i></button>
                        </form>
{{--                        <a href="#" class="" data-bs-toggle="modal" data-bs-target="#account_Attachment{{$actionPlan->id}}"><img src="{{asset('assets/img/icons/misc/pdf.png')}}" alt="Document image" width="30" class="me-2"></a>--}}
                        <!-- modal section -->
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
