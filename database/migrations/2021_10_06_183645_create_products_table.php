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
            $table->id();
            $table->string('product_name');
            //the url for each product that would help to top of search engine
            $table->string('slug')->uniqid();
            // It will be stored information about story, detail about product
            $table->text('details');
            //will talk about how that look like;
            //Ex: Sweet, bite-size, Dutch style puffy, pancake flovored
            $table->string('profile');
            //It references to category table
            $table->foreignId('category_id')->constrained();
            //It says about size and weight
            $table->string('size');
            //It tells about price of each product
            $table->float('price');
            //How many time of viewing
            $table->unsignedInteger('views')->default(0);
            //Opinion that user or viewer interested or not
            $table->unsignedInteger('interested')->default(0);
            //It tells about date would be introduced to customer
            $table->date('available_at');
            $table->timestamps();

            //Set reference to table categories
            // $table->foreign('category_id')->references('id')->on('categories');
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
