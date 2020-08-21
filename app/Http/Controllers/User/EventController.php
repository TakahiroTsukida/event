<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Event;
use App\Admin\Shop;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $shop_id = $request->input('shop_id');
        $date = $request->input('date');
        $query = Event::query();

        if (!empty($shop_id))
        {
            $events = $query->where('shop_id', $shop_id)->get();
            
        } else {

            $events = Event::all()->sortBy('start_time');
            $shop_id = null;

        }

        $shops = Shop::all();

        return view('user.event.index', [
            'events' => $events,
            'shops' => $shops,
            'shop_id' => $shop_id,
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


    public function unjoin(Request $request, Event $event)
    {
        $event->joins()->detach($request->user()->id);

        return redirect()->route('user.show', ['id' => Auth::guard('user')->user()->id]);
    }


    public function members(Event $event)
    {
        return view('user.event.members', ['event' => $event]);
    }
}