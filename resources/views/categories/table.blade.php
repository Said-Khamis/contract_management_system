<div class="list-group nested-list nested-sortable p-3">
    @forelse(@$categories as $category)
        @if($category->category_id == null)
            <div class="list-group-item nested-1" draggable="false">
                <i class="ri-arrow-right-s-line fs-16 align-middle text-primary me-2 caret"></i> {{ucwords($category->name)}}
                @if(!empty($category->categories))
                    <div class="list-group nested-list nested-sortable nested">
                        @foreach($category->categories as $childCategory)
                            <div class="list-group-item nested-2" draggable="false">
                                <div class="row">
                                    <div class="col-md-10">{{ucwords($childCategory->name)}}</div>
                                    <div class="col-md-2">
                                        <div class='btn-group'>
                                            <button type="button" class="btn btn-soft-secondary btn-sm data-modal" data-url="{{route('categories.show', [$childCategory->id])}}"><i class="ri-eye-fill"></i></button>
                                            <a class="btn btn-soft-secondary btn-sm" href="{{route('categories.edit', [$childCategory->id])}}"><i class="ri-pencil-fill"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif
    @empty
        <tr><td colspan="6" style="text-align: center; font-size: larger">No Categories</td></tr>
    @endforelse
</div>

