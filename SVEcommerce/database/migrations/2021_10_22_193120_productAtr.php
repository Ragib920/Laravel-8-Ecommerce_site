<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductAtr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productAtr', function (Blueprint $table) {
            $table->id();
            $table->string('sku');
            $table->string('attr_image');
            $table->integer('mrp');
            $table->integer('price');
            $table->integer('quantity');
            $table->integer('size_id');
            $table->integer('color_id');
            $table->integer('product_id');
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
        Schema::dropIfExists('productAtr');
    }
}
