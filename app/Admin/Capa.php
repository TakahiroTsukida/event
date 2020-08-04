<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Capa extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'people',
    ];

    protected $guarded = array('id');



    public static function register($form, $event)
    {
        foreach ($form['capa']['name'] as $key => $value)
        {
            if ($value != null)
            {
                $capa = new Capa;
                $capa->event_id = $event->id;
                $capa->name = $value;
                $capa->people = $form['capa']['people'][$key];
                $capa->save();
            }
        }
    }



    public function event(): BelongsTo
    {
        return $this->belongsTo('App\Admin\Event');
    }
}
