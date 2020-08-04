<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Price extends Model
{
    protected $fillable = [
        'event_id',
        'gender',
        'status',
        'price',
        'notes',
    ];

    protected $guarded = array('id');



    public static function register($form, $event)
    {
        foreach ($form['price']['gender'] as $key => $value)
        {
            if ($value != null)
            {
                $price = new Price;
                $price->event_id = $event->id;
                $price->gender = $value;
                $price->status = $form['price']['status'][$key];
                $price->price = $form['price']['price'][$key];
                $price->notes = $form['price']['notes'][$key];
                $price->save();
            }
        }
    }



    public function event(): BelongsTo
    {
        return $this->belongsTo('App\Admin\Event');
    }
}
