<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('product_category_id');
            $table->unsignedBigInteger('product_subcategory_id');

            $table->string('name');
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
            $table->string('image_4')->nullable();
            $table->text('product_content');

            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('member_id')->references('id')->on('members');
            $table->foreign('product_category_id')->references('id')->on('product_categories');
            $table->foreign('product_subcategory_id')->references('id')->on('product_subcategories');
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
