<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('writer_id')->comment('作者');
            $table->unsignedBigInteger('category_id')->comment('文章所屬分類');
            $table->longText('content')->comment('文章內容');
            $table->jsonb('reply')->comment('回覆')->nullable();
            $table->jsonb('others')->comment('其他')->nullable();
            $table->foreign('category_id')->references('id')->on('category')->onUpdate('cascade');
            $table->foreign('writer_id')->references('id')->on('users')->onUpdate('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
