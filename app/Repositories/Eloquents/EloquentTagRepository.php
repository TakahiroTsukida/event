<?php

namespace App\Repositories\Eloquents;

use App\Admin\Event;
use App\Admin\Tag;
use App\Repositories\Contracts\TagContract;
use Illuminate\Support\Collection;

class EloquentTagRepository implements TagContract
{
    /**
     * @var Tag
     */
    private $tag;

    /**
     * EloquentTagRepository constructor.
     * @param Tag $tag
     */
    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    /**
     * @inheritDoc
     */
    public function storeNewTags(?Collection $eventTags, Event $event): void
    {
        if ($eventTags) {
            foreach ($eventTags as $tagName) {
                $tag = $this->tag->firstOrCreate(['name' => $tagName]);
                $event->tags()->attach($tag);
            }
        }
    }
}
