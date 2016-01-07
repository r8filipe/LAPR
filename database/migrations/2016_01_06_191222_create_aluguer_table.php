<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAluguerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aluguer', function (Blueprint $table) {

            $table->increments('id');
            $table->timestamp('start');
            $table->timestamp('end');
            $table->integer('book_id');
            $table->integer('user_id');
            $table->string('payment_id');
            $table->index('user_id');
            $table->index('book_id');

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
        //
    }
}
