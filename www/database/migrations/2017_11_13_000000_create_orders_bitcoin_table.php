<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersBitcoinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_bitcoin', function (Blueprint $table) {
            $table->increments('oid');

            $table->string('bs');
            $table->double('price');
            $table->double('amount');
			$table->string('email');
            $table->double('pa_total');

            $table->string('uid');
            $table->date('wdate');

            $table->string('state');
            $table->date('sdate');

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
        Schema::dropIfExists('orders_bitcoin');
    }
}
