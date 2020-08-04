<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Storage;

class Shop extends Model
{
    protected $fillable = [
        'name',
        'tel',
        'postcode',
        'ken',
        'city',
        'block',
        'open',
        'close',
        'web',
        'image_path',
    ];

    protected $guarded = array('id');



    public static function register($request, $shop)
    {
        $shop->fill($request->all());
        
        if (isset($request->image))
        {
            $path = $request->image->store('public/image/shop_images');
            $shop->image_path = basename($path);

        } elseif (isset($request->remove)) {

            if ($shop->image_path)
            {
                Storage::delete("public/image/shop_images/$shop->image_path");
                $shop->image_path = null;
            }
        }

        $shop->save();
    }



    public function events(): HasMany
    {
        return $this->hasMany('App\Admin\Event');
    }
}