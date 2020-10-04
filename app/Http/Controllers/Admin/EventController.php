<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEvent;
use Illuminate\Http\Request;
use App\Admin\Event;
use App\Admin\Shop;
use App\Admin\Price;
use App\Admin\Schedule;
use App\Admin\Tag;
use App\Admin\Capa;
use App\Http\Requests\EventRequest;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function create()
    {
        $shops = Shop::all();
        $allTagNames = Tag::all()->map(function($tag) {
            return ['text' => $tag->name];
        });
        
        return view('admin.event.create', [
            'shops'       => $shops,
            'allTagNames' => $allTagNames,
        ]);
    }

    public function store(EventRequest $request, Event $event)
    {
        $form = $request->all();
        Event::register($request, $event);
        Price::register($form, $event);
        Schedule::register($form, $event);
        Capa::register($form, $event);

        $request->tags->each(function($tagName) use ($event) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $event->tags()->attach($tag);
        });

        return redirect()->route('top');
    }


    public function edit(Event $event)
    {
        $shops = Shop::all();
        $tagName = $event->tags->map(function($tag) {
            return ['text' => $tag->name];
        });

        $allTagNames = Tag::all()->map(function($tag) {
            return ['text' => $tag->name];
        });

        return view('admin.event.edit', [
            'event'       => $event,
            'shops'       => $shops,
            'tagName'     => $tagName,
            'allTagNames' => $allTagNames,
        ]);
    }


    public function update(EventRequest $request, Event $event)
    {
        $form = $request->all();
        
        Event::register($request, $event);
        Price::where('event_id', $event->id)->delete();
        Price::register($form, $event);
        Schedule::where('event_id', $event->id)->delete();
        Schedule::register($form, $event);
        Capa::where('event_id', $event->id)->delete();
        Capa::register($form, $event);
        $event->tags()->detach();
        $request->tags->each(function($tagName) use ($event) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $event->tags()->attach($tag);
        });

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
