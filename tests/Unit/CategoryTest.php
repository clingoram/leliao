<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function setUp(): void
    {
        // 呼叫父類別的 setUp()
        parent::setUp();
        $this->initDatabase();
    }

    public function tearDown(): void
    {
        $this->resetDatabase();
        // 呼叫子類別的 tearDown()
        parent::tearDown();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_add_category()
    {
        $data = Category::make();
        $response = $this->post("api/lel/f/all", [
            'name' => $data['name'],
            'created_at' => $data['created_at']
        ])->assertLocation('/');
    }

    /**
     * Check duplicate
     */
    public function test_category_duplication()
    {
        $data = Category::make([
            'name' => '休閒娛樂',
            'created_at' => '2021-11-12 09:13:26'
        ]);

        $data2 = Category::make([
            'name' => '工作',
            'created_at' => '2021-11-11 09:13:26'
        ]);

        $this->assertTrue($data->name !== $data2->name);
    }

    public function test_database_count_data()
    {
        $this->assertDatabaseCount('category', 3);
    }
}
