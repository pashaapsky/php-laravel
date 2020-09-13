<div class="tags-cloud d-flex flex-column col-12 col-sm-4 col-lg-2 order-1">
    @if($tagsCloud->isNotEmpty())
        <h3 class="tags-cloud__header text-center">Available Tags</h3>

        @include('layouts.posts.tags', ['tags' => $tagsCloud])
    @else
        <h3 class="tags-cloud__header text-center">No available tags</h3>
    @endif
</div>
