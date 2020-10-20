<?php


namespace App\Services;

use App\Tag;
use App\Taggable;

class TagsCreatorService
{
    protected $model;
    protected $request;

    public function __construct($model, $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function updateTags() {
        $modelTags = $this->model->tags->keyBy('name');

        if (!is_null($this->request['tags'])) {
            $requestTags = collect(explode(', ', $this->request['tags']))->keyBy(function ($item) { return $item; });
        } else {
            $requestTags = collect([]);
        }

        $deleteTags = $modelTags->diffKeys($requestTags);
        $addTags = $requestTags->diffKeys($modelTags);

        if ($addTags->isNotEmpty()) {
            foreach ($addTags as $tag) {
                $tag = Tag::firstOrCreate(['name' => $tag]);
                $this->model->tags()->attach($tag);
            };
        }

        if ($deleteTags->isNotEmpty()) {
            foreach ($deleteTags as $tag) {
                $this->model->tags()->detach($tag);
                $isLastTag = Taggable::where('tag_id', $tag->id)->first();
                if (!$isLastTag) $tag->delete();
            };
        }
    }
}
