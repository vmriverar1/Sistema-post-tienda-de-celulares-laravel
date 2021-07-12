<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('ruc')->nullable();
            $table->string('celular')->nullable();
            $table->string('direccion')->nullable();
            $table->string('cumpleaños')->nullable();
            $table->string('email')->nullable();
            $table->string('foto')->nullable();
            $table->string('compras')->nullable();
            $table->string('store')->nullable();
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
        Schema::dropIfExists('suppliers');
    }
}
