<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

/**
 * 文章的新增、編輯
 */
class PostController extends Controller
{
    protected $author;
    protected $title;
    protected $content;
    protected $category;
    protected $replyUsers;
    protected $emoj;

    // public function __construct(Request $request)
    // {
    //     $this->author = $request->userId;
    //     $this->title = $request->title;
    //     $this->category = $request->category;
    //     $this->content = $request->content;
    // }

    public function create(Request $request)
    {
        $this->validateCheck($request);

        $post = new Post();
        $post->title = $request->content;
        $post->content = $request->content;
        $post->category_id = $request->category;
        $post->writer_id = $request->userId;
        $post->created_at = date('Y/m/d H:i:s', time());
        $post->save();

        return response()->json(
            ['status' => 'success'],
            200
        );
    }


    public function validateCheck(Request $request)
    {
        $result = Validator::make($request, [
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
