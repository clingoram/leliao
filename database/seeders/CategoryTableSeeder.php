<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Category::factory()->count(6)->create();

        $data = [
            ['id' => 1, 'name' => '閒聊', 'created_at' => date('Y/m/d H:i:s', time()), 'updated_at' => date('Y/m/d H:i:s', time())],
            ['id' => 2, 'name' => '工作', 'created_at' => date('Y/m/d H:i:s', time()), 'updated_at' => date('Y/m/d H:i:s', time())],
            ['id' => 3, 'name' => '美食', 'created_at' => date('Y/m/d H:i:s', time()), 'updated_at' => date('Y/m/d H:i:s', time())],

        ];
        foreach ($data as $key) {
            $category = new Category();
            $category->id = $key['id'];
            $category->name = $key['name'];
            $category->created_at = $key['created_at'];
            $category->updated_at = $key['updated_at'];

            $category->save();
        }
    }
}
