@forelse($news as $new)
    <div class="news-section__news new">
        <div class="new__item d-flex">
            <div class="new__heading d-flex flex-column p-3 w-100 border rounded mb-4 shadow-sm">
                <strong class="mb-2 text-primary">new #{{ $new->id }}</strong>

                <h3 class="new__name mb-0">{{ $new->name }}</h3>

                <div class="new__created-at mb-1 text-muted">{{ $new->created_at->toFormattedDateString() }}</div>

                <p class="new__preview card-text flex-grow-1 text-justify">  {{ str_limit($new->text, $limit = 100, $end = '...') }} </p>

                @if($new->tags->isNotEmpty())
                    <div class="post__tags mb-2">
                        @foreach($new->tags as $tag)
                            <a href="{{ route('tags.show', $tag) }}" class="badge badge-info text-white">{{ $tag->name }}</a>
                        @endforeach
                    </div>
                @endif

                <a href="{{ route('news.show', $new) }}" class="new__view">Continue reading</a>
            </div>
        </div>
    </div>
@empty
    <p class="no-news">No available news yet</p>
@endforelse


