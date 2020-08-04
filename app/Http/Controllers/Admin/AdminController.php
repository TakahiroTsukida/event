<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Admin;
use App\Http\Requests\AdminRequest;


class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        
        return view('admin.profile.index', ['admins' => $admins]);
    }

    
    public function create()
    {
        return view('admin.profile.create');
    }


    public function store(AdminRequest $request, Admin $admin)
    {
        Admin::register($request, $admin);

        return redirect()->route('admin.index');
    }


    public function edit(Admin $admin)
    {
        return view('admin.profile.edit', ['admin' => $admin]);    
    }


    public function update(AdminRequest $request, Admin $admin)
    {
        Admin::register($request, $admin);

        return redirect()->route('admin.index');
    }


    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admin.index');
    }

}
