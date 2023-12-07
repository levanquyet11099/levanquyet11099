<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehousingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_issue', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pw_user_id')->unsigned()->nullable();
            $table->foreign('pw_user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('w_code', 15)->nullable();
            $table->string('w_name', 255)->nullable();
            $table->string('w_note', 255)->nullable();
            $table->tinyInteger('w_type')->nullable();
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
        Schema::dropIfExists('goods_issue');
    }
}
