<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function signin()
    {
        return view("admin.signin");
    }
    /**
     * @param $request
     * @param $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function log(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:users,email',
                'password' => 'required'
            ]);
            $credentials = ['email' => $request->email, 'password' => $request->password];
            if (Auth::attempt($credentials)) {
                $user = \auth()->user();
                Session::flash('message', "Login Successfully");
                return redirect('/admin/posts');
            } else {
                Session::flash('message', "Please Enter Valid Email id or Password");
                return redirect('/admin/signIn');
            }
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        try {
            Auth::logout();
            return redirect('/admin/signIn');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }
}
