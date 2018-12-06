<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 板块表
        Schema::create('plates', function (Blueprint $table) {
            $table->increments('id');
            $table->char('title', 32)->default('')->nullable(false)->comment('标题');
            $table->char('img_url', '255')->default('')->nullable(false)->comment('图片url');
            $table->char('link_url', '255')->default('')->nullable(false)->comment('链接url');
            $table->integer('sort')->default(0)->nullable(false)->comment('排序');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plates');
    }
}
