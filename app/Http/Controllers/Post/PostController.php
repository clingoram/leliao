<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Models\Auth;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;

/**
 * 針對單一文章的新增、編輯
 */
class PostController extends Controller
{
    /** 
     * 建立新文章
     */
    public function create(Request $request)
    {
        $this->validateCheck($request);

        $checkUser = Auth::where('id', '=', $request->post['writer_id'])->exists();
        $checkCategory = Category::where('id', '=', $request->post['category_id'])->exists();
        $checkPostId = Post::select('id')->get();

        if ($checkCategory and $checkUser) {
            $post = new Post();
            $post->id = $checkPostId->count() + 1;
            $post->title = $request->post['title'];
            $post->content = $request->post['content'];
            $post->category_id = $request->post['category_id'];
            $post->writer_id = $request->post['writer_id'];
            $post->created_at = date('Y/m/d H:i:s', time());
            $post->save();

            return response()->json(
                ['status' => 'success'],
                200
            );
        } else {
            return response()->json(
                ['status' => 'fail'],
                400
            );
        }
    }

    /**
     * modal 取得特定看板內的某篇文章
     * */
    public function show(int $categoryId, int $postId)
    {
        $find = Post::select(
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
        )->join('category', 'category.id', '=', 'posts.category_id')
            ->join('users', 'users.id', '=', 'posts.writer_id')
            ->where('category.id', $categoryId)
            ->where('posts.id', $postId)->first();

        if (isset($find)) {
            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data_return' => $find
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
     * 取得該帳號所有留言
     * 回傳留言的文章標題、留言內容、留言時間
     */
    public function getAllReplies(int $id, string $name)
    {
        $all = Comment::select(
            'comments.id',
            'comments.content',
            'comments.created_at',
            'posts.title'
        )->join('posts', 'posts.id', '=', 'comments.post_id')
            ->where('user_id', $id)
            ->where('name', $name)
            ->get();
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data_return' => $all
        ], 200);
    }

    /**
     * 檢查
     */
    public function validateCheck(Request $request)
    {
        $result = Validator::make($request->all(), [
            'writer_id' => ['required', 'int'],
            'title' => ['required', 'string'],
            'content' => ['required', 'string'],
            'category_id' => ['required', 'int']
        ]);

        if ($result->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $result->errors()
            ], 422);
        } else {
            return response()->json(
                ['status' => true],
                200
            );
        }
    }
}
