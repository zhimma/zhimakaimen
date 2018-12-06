<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('position')->default(0)->nullable(false)->comment('banner 位置');
            $table->tinyInteger('type')->default(0)->nullable(false)->comment('类型：0-不跳转，1-跳转链接');
            $table->char('title', 32)->default('')->nullable(false)->comment('标题');
            $table->char('description', 128)->default('')->nullable(false)->comment('描述简介');
            $table->char('img_url', '255')->default('')->nullable(false)->comment('图片url');
            $table->char('link_url', '255')->default('')->nullable(false)->comment('图片url');
            $table->integer('click_count')->default(0)->nullable(false)->comment('点击次数');
            $table->integer('show_time')->default(0)->nullable(false)->comment('上架时间');
            $table->integer('disable_time')->default(0)->nullable(false)->comment('下架时间');
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
        Schema::dropIfExists('banners');
    }
}
