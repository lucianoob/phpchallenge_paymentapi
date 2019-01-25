<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('credit_cards')) {
            Schema::create('credit_cards', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name_card');
                $table->string('number_card')->unique();
                $table->string('expiration');
                $table->string('ccv');
                $table->string('is_valid');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credit_cards');
    }
}
