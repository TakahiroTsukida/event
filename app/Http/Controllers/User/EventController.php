<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Prefecture;
use Illuminate\Http\Request;
use App\Admin\Event;
use App\Admin\Shop;
use App\Admin\Tag;
use App\Services\Event\EventServiceInterface;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * @var EventServiceInterface
     */
    private $eventServiceInterface;

    /**
     * EventController constructor.
     * @param EventServiceInterface $eventServiceInterface
     */
    public function __construct(EventServiceInterface $eventServiceInterface)
    {
        $this->eventServiceInterface = $eventServiceInterface;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
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

        // パラメーター取得
        $params = [
            'tags'    => $request->input('tags'),
            'shop_id' => $request->input('shop_id'),
            'date'    => $date ?: today(),
            'pref'    => $pref,
            'city'    => $city,
        ];

        $events = $this->eventServiceInterface->searchEvents($params);

        //検索shopのselect用
        $shops = Shop::all();
        $allTags = Tag::all();
        $prefs = Prefecture::all();

        return view('user.event.index', [
            'events'  => $events,
            'tags'    => $params['tags'],
            'shops'   => $shops,
            'shop_id' => $params['shop_id'],
            'date'    => $params['date'],
            'allTags' => $allTags,
            'prefId'  => $prefId,
            'cityId'  => $cityId,
            'prefs'   => $prefs,
            'url'     => 'user',
        ]);

    }

    /**
     * @param Event $event
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Event $event)
    {
        return view('user.event.show', ['event' => $event]);
    }

    /**
     * @param Request $request
     * @param Event $event
     * @return array
     */
    public function like(Request $request, Event $event)
    {
        $event->likes()->detach($request->user()->id);
        $event->likes()->attach($request->user()->id);

        return [
            'id' => $event->id,
            'countLikes' => $event->count_likes,
        ];
    }

    /**
     * @param Request $request
     * @param Event $event
     * @return array
     */
    public function unlike(Request $request, Event $event)
    {
        $event->likes()->detach($request->user()->id);

        return [
            'id' => $event->id,
            'countLikes' => $event->count_likes,
        ];
    }

    /**
     * @param Event $event
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function join_form(Event $event)
    {
        return view('user.event.join_form', ['event' => $event]);
    }

    /**
     * @param Request $request
     * @param Event $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function join(Request $request, Event $event)
    {
        $request->validate([
            'kiyaku' => 'required',
        ]);
        $event->joins()->detach($request->user()->id);
        $event->joins()->attach($request->user()->id);

        return redirect()->route('user.show', ['id' => Auth::guard('user')->user()->id]);
    }

    /**
     * @param Event $event
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function unjoinConfirmation(Event $event)
    {
        $join_members = $event->joins()->get();
        $join_user = $join_members->where('id', Auth::guard('user')->user()->id);
        if (empty($join_user)) {
            return back()->withInput();
        }
        return view('user.event.unjoin_form', ['event' => $event]);
    }

    /**
     * @param Request $request
     * @param Event $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unjoin(Request $request, Event $event)
    {
        $request->validate([
            'kiyaku' => 'required',
        ]);
        $event->joins()->detach($request->user()->id);

        return redirect()->route('user.show', ['id' => Auth::guard('user')->user()->id]);
    }

    /**
     * @param Event $event
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function members(Event $event)
    {
        return view('user.event.members', ['event' => $event]);
    }
}
