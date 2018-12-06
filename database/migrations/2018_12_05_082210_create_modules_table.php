<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('position')->default(0)->nullable(false)->comment('module 位置');
            $table->integer('parent_module_id')->default(0)->nullable(false)->comment('module 内容');
            $table->char('title', 32)->default('')->nullable(false)->comment('标题');
            $table->char('img_url', '255')->default('')->nullable(false)->comment('图片url');
            $table->tinyInteger('relation_type')->default(0)->nullable(false)->comment('关联类型：');
            $table->text('relation_content')->comment('关联内容');
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
        Schema::dropIfExists('modules');
    }
}
