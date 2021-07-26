<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('type_account_id')->unsigned();
            $table->foreign('type_account_id')->references('id')->on('type_account');
            $table->string('name', 50);
            $table->bigInteger('number_');
            $table->decimal('value', 10, 2);
            $table->enum('type_', ['Cuentas Propias', 'Cuantas a Tercero', 'Cuentas Inscritas']);
            $table->integer('state');
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
        Schema::dropIfExists('account');
    }
}
