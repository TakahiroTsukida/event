<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Event;
use App\Admin\Shop;
use App\Admin\Tag;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $tags = $request->input('tags');
        $shop_id = $request->input('shop_id');
        $date = $request->input('date');
        $query = Event::query();

        //ここから検索フォーム
        //目的（タグ）で検索
        if (isset($tags)) {
            $query->join('event_tag', 'events.id', '=', 'event_tag.event_id')
                ->whereIn('event_tag.tag_id', $tags)
                ->select('events.*');
        } else {
            $tags = null;
        }

        //お店で検索
        if (isset($shop_id)) {
            $query->where('shop_id', $shop_id)->get();
        } else {
            $query->get();
            $shop_id = null;
        }

        //日付で検索
        if (empty($date))
        {
            $date = Carbon::now()->format('Y-m-d h:i:s');
        }
        $query->whereDate('start_time', '>=', $date)->get();

        $events = $query->get()->unique('id')->sortBy('start_time');

        //検索shopのselect用
        $shops = Shop::all();
        $allTags = Tag::all();
        //viewで日付を表示用にフォーマット変換
        $date = explode(' ', $date);

        return view('user.event.index', [
            'events'  => $events,
            'tags'    => $tags,
            'shops'   => $shops,
            'shop_id' => $shop_id,
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