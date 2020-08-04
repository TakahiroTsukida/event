<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'begin',
        'end',
        'descripsion',
    ];

    protected $guarded = array('id');



    public static function register($form, $event)
    {
        foreach ($form['schedule']['name'] as $key => $value)
        {
            if ($value != null)
            {
                $schedule = new Schedule;
                $schedule->event_id = $event->id;
                $schedule->name = $value;
                $schedule->begin = $form['schedule']['begin'][$key];
                $schedule->end = $form['schedule']['end'][$key];
                $schedule->descripsion = $form['schedule']['descripsion'][$key];
                $schedule->save();
            }
        }
    }



    public function event(): BelongsTo
    {
        return $this->belongsTo('App\Admin\Event');
    }
}
