<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('p_category_id')->unsigned()->nullable();
            $table->foreign('p_category_id')->references('id')->on('category')
                ->onUpdate('cascade');
            $table->unsignedInteger('p_unit_id')->unsigned()->nullable();
            $table->foreign('p_unit_id')->references('id')->on('units')
                ->onUpdate('cascade');
            $table->unsignedInteger('p_user_id')->unsigned()->nullable();
            $table->foreign('p_user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('p_code', 15)->nullable();
            $table->string('p_name', 255)->nullable();
            $table->string('p_images', 255)->nullable();
            $table->float('p_entry_price', 15, 2)->nullable();
            $table->float('p_retail_price', 15, 2)->nullable();
            $table->float('p_cost_price', 15, 2)->nullable();
            $table->integer('p_total_number')->nullable()->default(0);
            $table->string('p_description',160)->nullable();
            $table->longText('p_content')->nullable();
            $table->tinyInteger('p_status')->default(1);
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
        Schema::dropIfExists('products');
    }
}
