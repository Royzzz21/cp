<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChargeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charge', function (Blueprint $table) {
            $table->increments('idx');

            // 지갑아이디, 사용자아이디, 지갑생성일
            $table->string('lv');    // lvl 1~9
			$table->string('kind');  // 4type : normal, margin ( maker, taker, margin_maker, margin_taker )
			$table->string('maker_charge');   // charge
			$table->string('taker_charge');   // charge
            $table->date('reg_date');
			
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
        Schema::dropIfExists('charge');
    }
}
