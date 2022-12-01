<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function loginadmin()
    {
        return view('admin/login');
    }
    public function prosesadmin(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/admin/home');
        } else {
            return redirect('/admin');
        }
    }
}
