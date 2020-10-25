<?php

namespace App\Repositories\Eloquents;

use App\Admin\Event;
use App\Repositories\Contracts\EventContract;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentEventRepository implements EventContract
{
    private $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    /**
     * @inheritDoc
     */
    public function storeNewEvent(array $eventRecords): object
    {
        return $this->event->create([
            'name'       => $eventRecords['name'],
            'shop_id'    => $eventRecords['shop_id'],
            'title'      => $eventRecords['title'],
            'start_time' => $eventRecords['start_time'],
            'end_time'   => $eventRecords['end_time'],
            'deadline'   => $eventRecords['deadline'],
            'descripsion'=> $eventRecords['descripsion'],
            'conditions' => $eventRecords['conditions'],
            'image_path' => $eventRecords['image_path'],
        ]);
    }

    /**
     * @inheritDoc
     */
    public function searchEvents(array $params): LengthAwarePaginator
    {
        $query = $this->event::with('tags');

        //ここから検索フォーム
        //目的（タグ）で検索
        if (isset($params['tags'])) {
            $query->whereHas('tags', function ($query) use ($params) {
                $query->whereIn('tag_id', $params['tags']);
            });
        }

        //お店で検索
        if (isset($params['shop_id'])) {
            $query->where('shop_id', $params['shop_id']);
        }

        //日付で検索
        if (isset($params['date'])) {
            $query->whereDate('start_time', '>=', $params['date']);
        }

        return $query->orderBy('start_time')
                    ->paginate(10);
    }
}
