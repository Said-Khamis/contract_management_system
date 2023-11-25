<div class="p-2">
    <table class="table table-responsive table-sm table-nowrap p-3" id="contractNotices-table">
        <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Notice Type</th>
            <th>Notice Date</th>
            <th>Notice Details</th>
            <th>File</th>
            <th width="80" class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($contractNotices as $contractNotice)
            <tr>
                <td class=""><center>{{ $loop->iteration }}</center></td>
                <td class="">{{ $contractNotice->notice_type }}</td>
                <td class="">{{ $contractNotice->notice_date }}</td>
                <td>{{ strlen($contractNotice->details) > 100 ? substr($contractNotice->details, 0, 100) . '...' : $contractNotice->details }}</td>
                <td>
                    @foreach($contractNotice->attachments as $attachment)
                        <a style="color: blue;margin-right: 2em" href="#" title="View {{ucwords(str_replace("_", " ", $attachment->name))}} File" class=""
                           data-bs-toggle="modal" data-bs-target="#attachment{{$attachment->id}}">
                            <i class="ri-file-pdf-fill align-bottom me-2 text-muted">
                            </i>
                            {{ucwords(str_replace("_", " ", $attachment->name))}}
                        </a>
                        <!-- modal section -->
                        <div class="modal fade" id="attachment{{$attachment->id}}" data-bs-backdrop="static" tabindex="-1"
                             aria-labelledby="varyingContentModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{$attachment->name}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <iframe style="width: 100%;height: 600px;"
                                                src="{{\Illuminate\Support\Facades\Storage::url($attachment->url)}}"
                                                title="Attachment"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </td>
                <td width="80" style="align-items: center;">
                    <div class='btn-group'>
                        <button type="button" class="btn btn-soft-success btn-sm data-modal"
                                data-url="{{ route('contractNotices.show', [$contractNotice->id]) }}"><i
                                class="ri-eye-fill"></i></button>
                        <button type="button" class="btn btn-soft-secondary btn-sm data-modal"
                           data-url="{{ route('contractNotices.edit', [$contractNotice->id]) }}"><i class="ri-edit-fill"></i></button>
                        <form action="{{route('contractNotices.delete',$contractNotice->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-soft-danger btn-sm" ><i class="ri-delete-bin-fill"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
