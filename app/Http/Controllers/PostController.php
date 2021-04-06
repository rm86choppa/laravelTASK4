<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Http\Requests\EditPostRequest;
use App\Http\Requests\NewPostRequest;

class PostController extends Controller
{
    //ログインしているかチェックし、してない場合ログイン画面に遷移させる
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //全投稿情報取得(投稿に紐づくユーザ情報も取得)
        $posts = Post::with('user', 'users')->get();

        return view('post', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('newPost');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\NewPostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewPostRequest $request)
    {
        //DBに投稿を新規追加
        $post = new Post;
        $postData = $request->all();
        unset($postData['_token']);
        $post->fill($postData)->save();

        return redirect('post');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*$post = $request->all();
        unset($post['_token']);
        $post['id'] = $id;*/

        $post = Post::find($id);

        return view('editPost', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\EditPostRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditPostRequest $request, $id)
    {
        $post = Post::find($id)->update(['title' => $request->title, 'content' => $request->content]);
        
        return redirect('post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::find($id)->delete();

        return redirect('post');
    }
}
