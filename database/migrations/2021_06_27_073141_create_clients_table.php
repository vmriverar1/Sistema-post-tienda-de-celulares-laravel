<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('dni')->nullable();
            $table->string('celular')->nullable();
            $table->string('direccion')->nullable();
            $table->string('cumpleaños')->nullable();
            $table->string('email')->nullable();
            $table->string('ventas')->nullable();
            $table->string('store')->nullable();
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
