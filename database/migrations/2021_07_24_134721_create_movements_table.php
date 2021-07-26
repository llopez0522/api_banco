<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movements', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('account_id')->unsigned();
            $table->foreign('account_id')->references('id')->on('account');
            $table->bigInteger('bank_id')->unsigned();
            $table->foreign('bank_id')->references('id')->on('banks');
            $table->bigInteger('type_movement_id')->unsigned();
            $table->foreign('type_movement_id')->references('id')->on('type_movement');
            $table->decimal('amount', 10, 2);
            $table->timestamp('date_');
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
        Schema::dropIfExists('movements');
    }
}
