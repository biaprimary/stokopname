<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_transaction')->unsigned();
            $table->integer('id_item')->unsigned();
            $table->foreign('id_transaction')->references('id')->on('transactions')->onDelete('cascade');
            $table->foreign('id_item')->references('id')->on('items')->onDelete('cascade');
            $table->integer('qty');
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
        Schema::table('transaction_details', function (Blueprint $table) {
          //
          $table->dropForeign('transaction_details_id_transaction_foreign');
          $table->dropForeign('transaction_details_id_item_foreign');
        });
        Schema::dropIfExists('transaction_details');
    }
}
