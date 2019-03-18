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
            $table->string('introImage');
            $table->string('coverImage');
            $table->string('productName');
            $table->string('productNameEn');
            $table->text('productDesc');
            $table->text('productDescEn');
            $table->text('introText');
            $table->text('introTextEn');
            $table->text('productText');
            $table->text('productTextEn');
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
