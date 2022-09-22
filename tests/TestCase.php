<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    protected function initDatabase()
    {
        // 動態修改設定，改接上 SQLite
        // config([
        //     'database.default' => 'sqlite',
        //     'database.connections.sqlite' => [
        //         'driver'    => 'sqlite',
        //         'database'  => ':memory:',
        //         'prefix'    => '',
        //     ],
        // ]);

        // 呼叫 php artisan migrate 建立 table
        // 呼叫 php artisan db:seed 匯入測試資料
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }

    protected function resetDatabase()
    {
        // php artisan migrate:reset
        // 清除所有 migrate
        Artisan::call('migrate:reset');
    }
}
