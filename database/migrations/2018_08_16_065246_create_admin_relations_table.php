<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_relations', function (Blueprint $table) {
            $table->increments('id')->autoIncrement();
            $table->integer('admin_id')->nullable(false)->default(0)->comment('admin id');
            $table->integer('province_id')->nullable(false)->default(0)->comment('省ID');
            $table->integer('city_id')->nullable(false)->default(0)->comment('市ID');
            $table->integer('area_id')->nullable(false)->default(0)->comment('区ID');
            $table->string('email',100)->nullable(false)->default('')->comment('email');
            $table->timestamps();
            $table->index('admin_id');
            $table->index('province_id');
            $table->index('city_id');
            $table->index('area_id');
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_relations');
    }
}
