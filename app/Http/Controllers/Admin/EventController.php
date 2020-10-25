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
use App\Services\Admin\AdminServiceInterface;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * @var AdminServiceInterface
     */
    private $adminServiceInterface;

    /**
     * EventController constructor.
     * @param AdminServiceInterface $adminServiceInterface
     */
    public function __construct(AdminServiceInterface $adminServiceInterface)
    {
        $this->adminServiceInterface = $adminServiceInterface;
    }

    /**
     * admin-event-create
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

    /**
     * admin-event-store
     * @param EventRequest $request
     * @param Event $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(EventRequest $request, Event $event)
    {
        $eventRecords = $request->input();
        $eventImage = $request->file('image');
        $eventTags = $request->tags?: null;

        $success = $this->adminServiceInterface->storeNewEvent($eventRecords, $eventImage, $eventTags);

        if ($success) {
            return redirect()->route('top');
        } else {
            return redirect()->route('admin.event.create');
        }
    }

    /**
     * admin-event-edit
     * @param Event $event
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

    /**
     * admin-event-update
     * @param EventRequest $request
     * @param Event $event
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * admin-event-destroy
     * @param Event $event
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
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
