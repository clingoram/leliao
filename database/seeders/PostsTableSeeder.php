<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Post::factory()->count(6)->create();

        $data = [
            [
                'title' => '關於Leliao',
                'author' => 1,
                'category_id' => 2,
                'content' => "「Leliao 了聊」是個人作品，沒有商業用途。概念來自網路PTT上的文章。會取名為「了聊」，是因為希望這個社群網站的文章可以讓人解到一些事情，再進階一點的功能則是希望是能做到可以跟其他使用者聊天。詳細資訊請到我的GitHub查看。最後，這篇文章是置頂喔!!!",
                'pin' => true,
                'created_at' => date('Y/m/d H:i:s', time()),
                'updated_at' => date('Y/m/d H:i:s', time())
            ],
        ];

        $i = 1;
        foreach ($data as $key) {
            $post = new Post();
            $post->id = $i;
            $post->title = $key['title'];
            $post->writer_id = $key['author'];
            $post->category_id = $key['category_id'];
            $post->content = $key['content'];
            $post->pin = $key['pin'];
            $post->created_at = $key['created_at'];
            $post->updated_at = $key['updated_at'];
            $post->save();
            $i++;
        }
    }
}
