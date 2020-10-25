<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Event;
use App\Admin\Shop;
use App\Admin\Tag;
use App\Services\Event\EventServiceInterface;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EventController extends Controller
{
    private $eventServiceInterface;

    public function __construct(EventServiceInterface $eventServiceInterface)
    {
        $this->eventServiceInterface = $eventServiceInterface;
    }


    public function index(Request $request)
    {
        $params = [
            'tags'    => $request->input('tags'),
            'shop_id' => $request->input('shop_id'),
            'date'    => $request->input('date'),
        ];

        $events = $this->eventServiceInterface->searchEvents($params);

        //検索shopのselect用
        $shops = Shop::all();
        $allTags = Tag::all();
        //viewで日付を表示用にフォーマット変換
        $date = isset($params['date']) ? new Carbon($params['date']) : today();

        return view('user.event.index', [
            'events'  => $events,
            'tags'    => $params['tags'],
            'shops'   => $shops,
            'shop_id' => $params['shop_id'],
            'date'    => $date,
            'allTags' => $allTags,
        ]);

    }


    public function show(Event $event)
    {

        return view('user.event.show', ['event' => $event]);
    }


    public function like(Request $request, Event $event)
    {
        $event->likes()->detach($request->user()->id);
        $event->likes()->attach($request->user()->id);

        return [
            'id' => $event->id,
            'countLikes' => $event->count_likes,
        ];
    }


    public function unlike(Request $request, Event $event)
    {
        $event->likes()->detach($request->user()->id);

        return [
            'id' => $event->id,
            'countLikes' => $event->count_likes,
        ];
    }


    public function join_form(Event $event)
    {
        return view('user.event.join_form', ['event' => $event]);
    }



    public function join(Request $request, Event $event)
    {
        $request->validate([
            'kiyaku' => 'required',
        ]);
        $event->joins()->detach($request->user()->id);
        $event->joins()->attach($request->user()->id);

        return redirect()->route('user.show', ['id' => Auth::guard('user')->user()->id]);
    }



    public function unjoinConfirmation(Event $event)
    {
        $join_members = $event->joins()->get();
        $join_user = $join_members->where('id', Auth::guard('user')->user()->id);
        if (empty($join_user)) {
            return back()->withInput();
        }
        return view('user.event.unjoin_form', ['event' => $event]);
    }



    public function unjoin(Request $request, Event $event)
    {
        $request->validate([
            'kiyaku' => 'required',
        ]);
        $event->joins()->detach($request->user()->id);

        return redirect()->route('user.show', ['id' => Auth::guard('user')->user()->id]);
    }


    public function members(Event $event)
    {
        return view('user.event.members', ['event' => $event]);
    }
}
