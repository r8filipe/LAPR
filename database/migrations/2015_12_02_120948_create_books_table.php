<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('subtitle');
            $table->string('publishedDate');
            $table->string('description');
            $table->string('pages');
            $table->string('language');
            $table->string('isbn10');
            $table->string('isbn13');
            $table->binary('cover');
            $table->float('price_day');
            $table->float('price_bail');
            $table->float('price_sale');

            $table->integer('id_publisher')->unsigned();
            $table->integer('id_user')->unsigned();

            $table->timestamps();
            $table->index('title');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('books');
    }
}
