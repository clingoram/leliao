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
                'content' => "Leliao是個人作品，沒有商業用途。使用Laravel+PostgreSQL+Vue做成的迷你社群網站。靈感來自網路PTT上的文章。會取名為「了聊」，是因為希望這個社群網站的文章可以讓人解到一些事情，再進階一點的功能則是計畫是能做到可以跟其他會員聊天。最後，這篇文章是置頂喔。",
                'pin' => true,
                'created_at' => date('Y/m/d H:i:s', time()),
                'updated_at' => date('Y/m/d H:i:s', time())
            ],
            // [
            //     'title' => '颱風軒嵐諾減弱中颱 氣象局發布海警不排除陸警 7縣市豪、大雨特報',
            //     'author' => 1,
            //     'category_id' => 1,
            //     'content' => '颱風軒嵐諾靠近台灣，中央氣象局今天表示，軒嵐諾強度稍減弱為中度颱風，目前中心在鵝鑾鼻東方海面，向西北轉北移動，其暴風圈正逐漸進入巴士海峽，對台灣東南部海面、東北部海面及巴士海峽構成威脅，於上午8時30發布海上颱風警報，預計此颱風暴風圈有擴大之趨勢，也不排除有發布陸警的機會。另外，受颱風外圍環流影響，氣象局發布7縣市豪、大雨特報。',
            //     'pin' => false,
            //     'created_at' => date('Y/m/d H:i:s', time()),
            //     'updated_at' => date('Y/m/d H:i:s', time())
            // ],
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
