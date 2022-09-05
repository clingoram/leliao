<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Models\Auth;
use App\Models\Forum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

/**
 * 針對單一文章的新增、編輯以及回應
 */
class PostController extends Controller
{
    protected $author;
    protected $title;
    protected $content;
    protected $category;
    protected $replyUsers;
    protected $emoj;

    // public function index()
    // {
    //     $all = Post::select(
    //         'posts.id',
    //         'posts.title',
    //         'posts.writer_id',
    //         'posts.content',
    //         'posts.reply',
    //         'posts.others',
    //         'posts.created_at',
    //         'category.name AS cName',
    //         'category.id AS cId',
    //         'users.name AS uName'
    //     )->join('category', 'category.id', '=', 'posts.category_id')
    //         ->join('users', 'users.id', '=', 'posts.writer_id')->get();

    //     if (isset($all)) {
    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Success',
    //             'data_return' => $all
    //         ], 200);
    //     } else {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Something wrong.',
    //             'data_return' => null,
    //         ], 400);
    //     }
    // }

    /** 
     * 建立新文章
     */
    public function create(Request $request)
    {
        // $this->validateCheck($request);

        $checkUser = DB::table('users')->where('id', '=', $request->post['writer_id'])->exists();
        $checkCategory = DB::table('category')->where('id', '=', $request->post['category_id'])->exists();

        // $user = Auth::find($request->post['id']);
        // $category = Forum::find($request->post['selected']);

        if ($checkCategory and $checkUser) {
            $post = new Post();
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

        // $article = Post::create([
        //     'title' => $request->post['articleTitle'],
        //     'content' => $request->post['articelContent'],
        //     'category_id' => $category,
        //     'writer_id' => $user->id,
        //     'created_at' => date('Y/m/d H:i:s', time())
        // ]);


    }

    /** 
     * 回覆特定文章(文章id,回覆者id,回覆內容,回覆時間)
     * column: jsonb
     */
    // TO-DO: jsonb儲存格式須修正、在vue如何顯示回應區、method show select jsonb格式
    public function reply(Request $request, int $postId)
    {

        // obj example - column name = contact
        // update customer
        // set contact = '{ "phones":[ {"type": "mobile", "phone": "001001"} , {"type": "fix", "phone": "002002"} ] }'
        // where id = '4ca27243-6a55-4855-b0e6-d6e1d957f289';

        // array example - column name = phones 
        // update customer
        // set phones = '[ {"type": "mobile", "phone": "001001"} , {"type": "fix", "phone": "002002"} ]'
        // where id = '4ca27243-6a55-4855-b0e6-d6e1d957f289';

        // --------------------
        // 似乎需要多一張表(comments)專門放置文章回應
        // -------------------------

        // 取得目前回應欄位有幾筆資料 jsonb_array_length()
        Post::where("id", $postId)->update(
            [
                // 'reply' => [
                //     'userId' => $data['userId'],
                //     'content' => $data['content'],
                //     'created_at' => date('Y/m/d H:i:s', time()),
                // 'push_notifications' => [
                //     'follow' => false,
                // ]
                // ],
                'reply' => [
                    'userId' => $request->data['replyUserId'],
                    'userName' => $request->data['replyUserName'],
                    'content' => $request->data['replyContent'],
                    'created_at' => date('Y/m/d H:i:s', time()),
                ],
            ]
        );
    }

    /**
     * 取得特定看板內的某文章
     * */
    public function show(int $categoryId, int $postId)
    {
        $find = Post::select(
            'posts.id',
            'posts.title',
            'posts.writer_id',
            'posts.content',
            // jsonb start
            'posts.reply->userName AS replyName',
            'posts.reply->content AS replyContent',
            'posts.reply->created_at AS replyTime',
            'posts.others',
            // jsonb end
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
