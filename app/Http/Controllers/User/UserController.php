<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Storage;

class UserController extends Controller
{
    public function show(string $id)
    {
        $user = User::find($id);
        
        return view('user.profile.show', ['user' => $user]);
    }


    public function edit()
    {
        $user = Auth::guard('user')->user();

        return view('user.profile.edit', ['user' => $user]);
    }


    public function update(Request $request)
    {
        $this->validate($request, User::$rules);

        $user = Auth::guard('user')->user();
        
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->birthday = $request->birthday;
        $user->introduction = $request->introduction;

        if (isset($request->image))
        {
            $path = $request->image->store('public/image/user_images');
            $user->image_path = basename($path);

        } elseif (isset($request->remove)) {

            if ($user->image_path)
            {
                Storage::delete("public/image/user_images/$user->image_path");
                $user->image_path = null;
            }
        }

        $user->save();

        return redirect()->route('user.show', ['id' => $user->id]);
    }
}
