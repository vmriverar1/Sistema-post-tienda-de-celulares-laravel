<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spends', function (Blueprint $table) {
            $table->id();
            $table->string('responsable');
            $table->string('tipo');
            $table->string('salida');
            $table->string('comprobante');
            $table->string('cod_comprobante');
            $table->string('productos','5000');
            $table->string('descripcion');
            $table->string('igv');
            $table->string('total');
            $table->string('store')->nullable();
            $table->string('foto');
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
        Schema::dropIfExists('spends');
    }
}
