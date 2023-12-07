<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductWarehousingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_warehousing', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pw_product_id')->unsigned()->nullable();
            $table->foreign('pw_product_id')->references('id')->on('products')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('pw_warehousing_id')->unsigned()->nullable();
            $table->foreign('pw_warehousing_id')->references('id')->on('goods_issue')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('pw_supplier_id')->unsigned()->nullable();
            $table->foreign('pw_supplier_id')->references('id')->on('supplier')
                ->onUpdate('cascade');
            $table->integer('pw_total_number')->nullable()->default(0);
            $table->date('pw_manufacturing_date')->nullable();
            $table->date('pw_expiry_date')->nullable();
            $table->tinyInteger('pw_active_price')->nullable();
            $table->float('pw_custom_price', 15, 2)->nullable();
            $table->float('pw_total_price', 15, 2)->nullable();
            $table->tinyInteger('pw_location')->nullable();
            $table->tinyInteger('pw_type')->nullable();
            $table->string('pw_note', 255)->nullable();
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
        Schema::dropIfExists('product_warehousing');
    }
}
