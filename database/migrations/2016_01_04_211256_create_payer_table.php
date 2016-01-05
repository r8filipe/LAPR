<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payer', function (Blueprint $table) {


            $table->increments('id');
            $table->string('payer_id');
            $table->string('email');
            $table->string('payment_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('recipient_name');
            $table->string('line1');
            $table->string('city');
            $table->string('state');
            $table->string('postal_code');
            $table->string('country_code');
            $table->string('phone');

            $table->index('payment_id');
            $table->index('email');

            $table->foreign('payment_id')->references('payment_id')->on('payment');
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
