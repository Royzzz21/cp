<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserWalletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_wallet', function (Blueprint $table) {
            $table->increments('idx');

            // 지갑아이디, 사용자아이디, 지갑생성일
            $table->string('wid');
            $table->string('uid');
            $table->date('reg_date');
			
			$table->date('wd_date');            // 입금일 또는 출금일
            $table->string('deposit_withdraw'); // 입금 또는 출금
			$table->string('money_type'); 		// 화폐종류
            $table->double('amount');           // 입금금액 또는 출금금액
			$table->double('wd_state');			// 0: 미완료 1: 완료
			
            // 화폐 종류별 잔고 및, 수수료비용
            $table->double('krw');
			$table->double('krw_charge');
            $table->double('bitcoin');
			$table->double('bitcoin_charge');
            $table->double('eth');
			$table->double('eth_charge');

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
        Schema::dropIfExists('user_wallet');
    }
}
