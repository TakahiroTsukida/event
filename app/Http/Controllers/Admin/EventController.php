<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEvent;
use Illuminate\Http\Request;
use App\Admin\Event;
use App\Admin\Shop;
use App\Admin\Price;
use App\Admin\Schedule;
use App\Admin\Capa;

class EventController extends Controller
{
    public function create()
    {
        $shops = Shop::all();
        
        return view('admin.event.create', ['shops' => $shops]);
    }


    public function store(CreateEvent $request, Event $event)
    {
        $form = $request->all();
        
        Event::register($request, $event);

        Price::register($form, $event);

        Schedule::register($form, $event);

        Capa::register($form, $event);

        return redirect()->route('top');
    }


    public function edit(Event $event)
    {
        $shops = Shop::all();

        return view('admin.event.edit', ['event' => $event, 'shops' => $shops]);
    }


    public function update(CreateEvent $request, Event $event)
    {
        $form = $request->all();
        
        Event::register($request, $event);

        Price::where('event_id', $event->id)->delete();
        Price::register($form, $event);

        Schedule::where('event_id', $event->id)->delete();
        Schedule::register($form, $event);

        Capa::where('event_id', $event->id)->delete();
        Capa::register($form, $event);

        return redirect()->route('top');
    }


    public function destroy(Event $event)
    {
        if(isset($event->image_path))
        {
            Storage::delete("public/image/event_images/$event->image_path");
        }
        $event->delete();
        return redirect()->route('top');
    }
}
