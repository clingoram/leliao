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
        $data = [
            [
                'title' => 'RabbitMQ',
                'author' => 1,
                'category_id' => 2,
                'content' => 'With tens of thousands of users, RabbitMQ is one of the most popular open source message brokers. From T-Mobile to Runtastic, RabbitMQ is used worldwide at small startups and large enterprises.RabbitMQ is lightweight and easy to deploy on premises and in the cloud. It supports multiple messaging protocols. RabbitMQ can be deployed in distributed and federated configurations to meet high-scale, high-availability requirements.RabbitMQ runs on many operating systems and cloud environments, and provides a wide range of developer tools for most popular languages.',
                'created_at' => date('Y/m/d H:i:s', time()),
                'updated_at' => date('Y/m/d H:i:s', time())
            ],
            [
                'title' => '颱風軒嵐諾減弱中颱 氣象局發布海警不排除陸警 7縣市豪、大雨特報',
                'author' => 1,
                'category_id' => 1,
                'content' => '颱風軒嵐諾靠近台灣，中央氣象局今天表示，軒嵐諾強度稍減弱為中度颱風，目前中心在鵝鑾鼻東方海面，向西北轉北移動，其暴風圈正逐漸進入巴士海峽，對台灣東南部海面、東北部海面及巴士海峽構成威脅，於上午8時30發布海上颱風警報，預計此颱風暴風圈有擴大之趨勢，也不排除有發布陸警的機會。另外，受颱風外圍環流影響，氣象局發布7縣市豪、大雨特報。',
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
            $post->created_at = $key['created_at'];
            $post->updated_at = $key['updated_at'];
            $post->save();
            $i++;
        }
    }
}
