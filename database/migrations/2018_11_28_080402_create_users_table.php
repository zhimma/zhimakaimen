<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->char('open_id', 32)->default('')->comment('openId')->unique();
            $table->char('union_id', 32)->default('')->comment('unionId');
            $table->char('nick_name', 32)->default('')->comment('nickName');
            $table->tinyInteger('gender')->default(0)->comment('性别');
            $table->char('city',20)->default('')->comment('city');
            $table->char('province',20)->default('')->comment('province');
            $table->char('country',20)->default('')->comment('country');
            $table->char('avatar_url',200)->default('')->comment('avatar_url');
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
        Schema::dropIfExists('users');
    }
}
