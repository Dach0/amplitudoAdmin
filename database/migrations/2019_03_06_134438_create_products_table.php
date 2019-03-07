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
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('product_images_id');
            $table->string('productName');
            $table->string('productNameEn');
            $table->text('product-desc');
            $table->text('product-descEn');
            $table->text('intro-text');
            $table->text('intro-textEn');
            $table->text('product-text');
            $table->text('product-textEn');
            $table->string('altTag');
            $table->string('altTagEn');
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
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
