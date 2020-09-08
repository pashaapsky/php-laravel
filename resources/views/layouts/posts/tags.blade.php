<div class="tags-cloud__tags list-group flex-row flex-wrap flex-sm-column justify-content-start mb-3 mb-sm-0">
    @foreach($tags as $tag)
        <a href="/tags/{{$tag->name}}" class="btn btn-sm btn-info text-white m-1">{{ strtoupper($tag->name) }}</a>
    @endforeach
</div>
