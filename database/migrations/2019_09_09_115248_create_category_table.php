<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('c_parent_id')->default(0)->index()->nullable();
            $table->unsignedInteger('c_supplier_id')->unsigned()->nullable();
            $table->foreign('c_supplier_id')->references('id')->on('supplier')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('c_name')->nullable();
            $table->string('c_code', 15)->unique()->nullable();
            $table->tinyInteger('c_active')->default(1);
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
        Schema::dropIfExists('category');
    }
}
