<?php

namespace App\Http\Controllers\Forum;

use App\Models\Forum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


session_start();
session_destroy();
/**
 * 分類看板
 */
class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $array = [];
        foreach (Forum::all() as $category) {
            // echo $category->name;
            array_push($array, $category);
        }
        return $array;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * 取得特定分類文章
     *
     * @param  \App\Models\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // $find = Forum::select(
        //     'posts.id',
        //     'posts.title',
        //     'posts.writer_id',
        //     'posts.content',
        //     'posts.reply',
        //     'posts.others',
        //     'posts.created_at',
        //     'category.name AS cName',
        //     'category.id AS cId',
        //     'users.name AS uName'
        // )->join('category', 'category.id', '=', 'posts.category_id')
        //     ->join('users', 'users.id', '=', 'posts.writer_id')->where('category.id', $id)->first();

        // return $find;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function edit(Forum $forum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Forum $forum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Forum $forum)
    {
        //
    }
}
