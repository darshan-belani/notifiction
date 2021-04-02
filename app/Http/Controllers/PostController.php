<?php

namespace App\Http\Controllers;

use App\Notifications\TestNotification;
use App\Posts;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class PostController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        try {
            $posts = Posts::get();
            return view('post.post', compact('posts'));
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getAllPost(Request $request)
    {
        try {
            if (auth()->user()->role == '1') {
                $getPostData = Posts::get();
            } else {
                $getPostData = Posts::where('user_id',\auth()->user()->id)->get();
            }
            $data = Datatables::of($getPostData)
                ->addColumn('action', function ($getPostData) {
                    return '<a href="' . url('/post/edit', $getPostData->id) . '" class="btn btn-sm btn-primary">
                <i class="glyphicon glyphicon-edit"></i> Edit</a>
                <a href="' . url('/post/delete', $getPostData->id) . '" class="btn btn-sm btn-danger">
                <i class="glyphicon glyphicon-edit"></i> Delete</a>';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
            return $data;
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        try {
            return view('post.add');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            $user = User::where('role','1')->first();
            $addPost = new Posts();
            $addPost->name = $request->post_name;
            $addPost->description = $request->post_description;
            $addPost->user_id = auth()->user()->id;
            if ($addPost->save()) {
                $user->notify(new TestNotification(Posts::findOrFail($addPost->id)));

            }
            return redirect('/posts');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markRead(Request $request)
    {
        try {
            auth()->user()->unreadNotifications->markAsRead();
            return redirect()->back();
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPost($id)
    {
        try {
            $editPost = Posts::where('id',$id)->first();
            return view('post.edit', compact('editPost'));
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updatePost(Request $request, $id)
    {
        try {
            $updatePost = Posts::where('id',$id)->first();
            $updatePost->name = $request->post_name;
            $updatePost->description = $request->post_description;
            $updatePost->save();
            return redirect('/posts');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deletePost($id)
    {
        try {
            $deletePost = Posts::where('id',$id)->first();
            $deletePost->delete();
            return redirect()->back();
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
    }
}
