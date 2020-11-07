<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEvent;
use App\Services\Event\EventServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Admin\Event;
use App\Admin\Shop;
use App\Admin\Price;
use App\Admin\Schedule;
use App\Admin\Tag;
use App\Admin\ReservationSeat;
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
     * @var EventServiceInterface
     */
    private $eventServiceInterface;

    /**
     * EventController constructor.
     * @param AdminServiceInterface $adminServiceInterface
     * @param EventServiceInterface $eventServiceInterface
     */
    public function __construct(
        AdminServiceInterface $adminServiceInterface,
        EventServiceInterface $eventServiceInterface
    )
    {
        $this->adminServiceInterface = $adminServiceInterface;
        $this->eventServiceInterface = $eventServiceInterface;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        // date は日付の文字列で渡ってくるため、変換してやる
        $formDate = $request->input('date');
        $date = null;
        if (isset($formDate)) {
            $form = date_parse_from_format('Y年m月d日', $formDate);
            $date = Carbon::create($form['year'], $form['month'], $form['day']);
        }
        // 都道府県 市区町村郡を取得
        $prefId = $request->input('pref');
        $cityId = $request->input('city');
        $pref = isset($prefId) ? $this->eventServiceInterface->fetchPrefData($prefId): null;
        $city = isset($cityId) && isset($pref) ? $this->eventServiceInterface->fetchCityData($pref, $cityId) : null;

        $params = [
            'name'    => $request->input('name'),
            'tags'    => $request->input('tags'),
            'shop_id' => $request->input('shop_id'),
            'date'    => $date ?: today(),
            'sort'    => $request->input('sort'),
            'pref'    => $pref,
            'city'    => $city,
        ];

        $events = $this->adminServiceInterface->searchEvents($params);

        $shops = Shop::all();
        $allTags = Tag::all();

        return view('admin.event.index', [
            'shops'   => $shops,
            'allTags' => $allTags,
            'events'  => $events,
            'name'    => $params['name'],
            'tags'    => $params['tags'],
            'shop_id' => $params['shop_id'],
            'date'    => $params['date'],
            'sort'    => $params['sort'],
            'url'     => 'admin',
            'prefId'  => $prefId,
            'cityId'  => $cityId,
        ]);
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
        ReservationSeat::where('event_id', $event->id)->delete();
        ReservationSeat::register($form, $event);
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
