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
    protected $replyUsers;
    protected $emoj;

    public function __construct(Request $request)
    {
        $this->author = $request->id;
        $this->title = $request->title;
        $this->content = $request->content;
    }

    public function create()
    {
        $post = new Post();
        $post->title = $this->title;
        $post->content = $this->content;
        $post->writer_id = $this->author;
        $post->created_at = date('Y/m/d H:i:s', time());
        $post->save();
    }


    public function validateCheck(array $data)
    {
        $result = Validator::make($data, [
            'writer_id' => ['required', 'int'],
            'title' => ['required', 'string'],
            'content' => ['required', 'string']
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
