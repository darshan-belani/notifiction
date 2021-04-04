<?php

namespace App\Http\Controllers;

use App\Posts;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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
                'email' => 'required|email|',
                'password' => 'required'
            ]);
            $credentials = ['email' => $request->email, 'password' => $request->password];
            if (Auth::attempt($credentials)) {
                $user = \auth()->user();
                Session::flash('message', "Login Successfully");
                return redirect('/posts');
            } else {
                Session::flash('message', "Please Enter Valid Email id or Password");
                return redirect('/signIn');
            }
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function regist(Request $request)
    {
        try {
            $addUser = new User();
            $addUser->name = $request->name;
            $addUser->email = $request->email;
            $addUser->password = Hash::make($request->password);
            $addUser->role = '2';
            $addUser->save();
            return redirect('signIn');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function users()
    {
        try {
            return view('user/users');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getAllUsers(Request $request)
    {
        try {
            $getPostData = User::get();
            $data = Datatables::of($getPostData)
                ->addColumn('action', function ($getPostData) {
                    return '<a href="' . url('/user/edit', $getPostData->id) . '" class="btn btn-sm btn-primary">
                <i class="glyphicon glyphicon-edit"></i> Edit</a>
                <a href="' . url('/user/delete', $getPostData->id) . '" class="btn btn-sm btn-danger">
                <i class="glyphicon glyphicon-edit"></i> Delete</a>';
                })
                ->editColumn('role', function ($row) {
                    foreach (config('config-variables.user_role') as $key => $value) {
                        if ($row->role == $key) {
                            return $value;
                        }
                    }
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            return $data;
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /*public function userAdd()
    {
        try {
            return view('user/add');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }*/
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userEdit($id)
    {
        try {
            $editUser = User::where('id',$id)->first();
            return view('user/edit',compact('editUser'));
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function userUpdate(Request $request, $id)
    {
        try {
            $updateUser = User::where('id',$id)->first();
            $updateUser->name = $request->name;
            $updateUser->email = $request->email;
            if ($request->role){
                $updateUser->role = $request->role;
            }
            $updateUser->save();
            return redirect('/users');
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
            return redirect('/signIn');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }
}
