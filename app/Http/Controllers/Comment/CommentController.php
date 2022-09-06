<?php

namespace App\Http\Controllers\Comment;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

/**
 * 單一文章回應
 * 
 */
class CommentController extends Controller
{

    public function createReply(Request $request)
    {
        $this->validateCheck($request);

        $comment = new Comment();
        $comment->category_id = $request->categoryId;
        $comment->post_id =  $request->postId;
        $comment->user_id = $request->data['replyUserId'];
        $comment->name = $request->data['replyUserName'];
        $comment->content = $request->data['replyContent'];
        $comment->created_at = date('Y/m/d H:i:s', time());
        $comment->save();
    }

    /*
    顯示單一文章回應
    */
    public function show(int $categoryId, int $postId)
    {
        $find = Comment::select(
            'comments.id',
            // 'comments.category_id',
            'comments.name AS replyName',
            'comments.content',
            'comments.created_at'
        )->join('posts', 'posts.id', '=', 'comments.post_id')
            ->join('category', 'category.id', '=', 'posts.category_id')
            ->where('comments.category_id', $categoryId)
            ->where('posts.id', $postId)
            ->orderByDesc('comments.created_at')
            ->get();

        if ($find) {
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

    public function validateCheck(Request $request)
    {
        try {
            $result = Validator::make($request->all, [
                'name' => ['required', 'string', 'max:30'],
                'content' => ['required', 'string', 'email', 'max:30', 'unique:users']
            ]);

            if ($result->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validator error',
                    'errors' => $result->errors()
                ], 401);
            } else {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Success'
                    ],
                    200
                );
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
