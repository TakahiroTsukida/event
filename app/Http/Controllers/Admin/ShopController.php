<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Shop;
use App\Http\Requests\ShopRequest;
use Storage;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::all();

        return view('admin.shop.index', ['shops' => $shops]);
    }


    public function create()
    {
        return view('admin.shop.create');
    }

    public function store(ShopRequest $request, Shop $shop)
    {
        Shop::register($request, $shop);

        return redirect()->route('admin.shop.index');
    }


    public function edit(Shop $shop)
    {
        return view('admin.shop.edit', ['shop' => $shop]);    
    }


    public function update(ShopRequest $request, Shop $shop)
    {
        Shop::register($request, $shop);

        return redirect()->route('admin.shop.index');
    }


    public function destroy(Shop $shop)
    {
        if (isset($shop->image_path))
        {
            Storage::delete("public/image/shop_images/$shop->image_path");
        }
        
        $shop->delete();
        return redirect()->route('admin.shop.index');
    }

    public function show(Shop $shop)
    {
        return view('admin.shop.show', ['shop' => $shop]);
    }
}
