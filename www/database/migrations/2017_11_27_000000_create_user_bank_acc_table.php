<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserBankAccTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_bank_acc', function (Blueprint $table) {
            $table->increments('idx');

            // 사용자아이디, 예금주, 화폐종류, 은행, 계좌번호
			$table->string('uid');
			$table->string('the_owner');
            $table->string('money_type');
			$table->string('bank');
			$table->string('account_number');
            $table->date('create_date');

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
        Schema::dropIfExists('user_bank_acc');
    }
}
