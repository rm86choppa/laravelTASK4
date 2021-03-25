<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewPostRequest;
use App\Post;

class NewPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('newPost');
    }

    /**
     * 新規投稿
     *
     * @return \Illuminate\Http\Response
     */
    public function store(newPostRequest $request)
    {
        //DBに投稿を新規追加
        $post = new Post;
        $postData = $request->all();
        unset($postData['_token']);
        $post->fill($postData)->save();

        return view('newPost');
    }
}
