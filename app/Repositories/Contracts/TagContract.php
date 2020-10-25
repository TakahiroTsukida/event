<?php

namespace App\Repositories\Contracts;


use App\Admin\Event;
use Illuminate\Support\Collection;

interface TagContract
{
    /**
     * Store Tag
     * @param Collection|null $eventTags
     * @param Event $event
     */
    public function storeNewTags(?Collection $eventTags, Event $event): void;
}
