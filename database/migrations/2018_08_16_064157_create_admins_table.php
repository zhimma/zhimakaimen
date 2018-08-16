<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account', 32)->nullable(false)->default('')->comment('登陆账号');
            $table->string('mobile', 11)->nullable(false)->default('')->comment('手机号');
            $table->string('nickname', 32)->nullable(false)->default('')->comment('昵称');
            $table->string('password', 64)->nullable(false)->default('')->comment('密码');
            $table->string('avatar', 255)->nullable(false)->default('')->comment('图像');
            $table->integer('age')->nullable(false)->default(0)->comment('年龄');
            $table->tinyInteger('sex')->nullable(false)->default(0)->comment('性别：0-未知，1-男，2-女');
            $table->timestamps();
            $table->index('account');
            $table->index('mobile');
            $table->index('nickname');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
