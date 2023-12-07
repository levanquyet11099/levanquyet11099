<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier', function (Blueprint $table) {
            $table->increments('id');
            $table->string('s_name', 255)->nullable();
            $table->string('s_code', 15)->unique()->nullable();
            $table->string('s_email', 100)->unique()->unique()->nullable();
            $table->string('s_phone', 15)->nullable();
            $table->string('s_fax', 15)->nullable();
            $table->string('s_website', 255)->nullable();
            $table->string('s_logo', 255)->nullable();
            $table->tinyInteger('s_status')->default(1);
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
        Schema::dropIfExists('supplier');
    }
}
