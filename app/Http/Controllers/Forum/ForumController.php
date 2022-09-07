<?php

namespace App\Http\Controllers\Forum;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * 首頁分類看板以及所屬看板的文章
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
        foreach (Category::all() as $category) {
            array_push($array, $category);
        }
        return $array;
    }

    /**
     * 首頁預設會出現的所有文章
     */
    public function defaultAllposts()
    {
        $all = Category::select(
            'posts.id',
            'posts.title',
            'posts.writer_id',
            'posts.content',
            'posts.reply',
            'posts.others',
            'posts.created_at',
            'category.name AS cName',
            'category.id AS cId',
            'users.name AS uName'
        )->join('posts', 'posts.category_id', '=', 'category.id')
            ->join('users', 'users.id', '=', 'posts.writer_id')->get();
        return $all;
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
    public function show(int $categoryId)
    {
        if ($categoryId !== 0) {
            $all = Category::select(
                'posts.id',
                'posts.title',
                'posts.writer_id',
                'posts.content',
                'posts.reply',
                'posts.others',
                'posts.created_at',
                'category.name AS cName',
                'category.id AS cId',
                'users.name AS uName'
            )->join('posts', 'posts.category_id', '=', 'category.id')
                ->join('users', 'users.id', '=', 'posts.writer_id')->where('category.id', $categoryId)->get();
        } else {
            $all = $this->defaultAllposts();
        }

        if (isset($all)) {
            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data_return' => $all
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Something wrong.',
                'data_return' => null,
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $forum)
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
    public function update(Request $request, Category $forum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $forum)
    {
        //
    }
}
