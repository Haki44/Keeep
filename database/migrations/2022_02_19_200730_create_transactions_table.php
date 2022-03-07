<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('offer_name');
            $table->foreign('offer_id')->references('id')->on('offers');
            $table->foreign('reply_user_id')->references('user_id')->on('replies');
            $table->foreign('offer_user_id')->references('user_id')->on('offers');
            $table->integer('offer_amount');
            $table->integer('offer_user_amount');
            $table->integer('reply_user_amount');
            $table->unsignedBigInteger('offer_id');
            $table->unsignedBigInteger('reply_user_id');
            $table->unsignedBigInteger('offer_user_id');
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
        Schema::dropIfExists('transactions');
    }
}
