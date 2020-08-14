<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Event;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all()->sortBy('start_time');
        
        return view('user.event.index', ['events' => $events]);

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