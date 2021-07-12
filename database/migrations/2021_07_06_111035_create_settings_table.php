<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('plantilla')->nullable();
            $table->string('menu',2000)->nullable();
            $table->string('crear',2000)->nullable();
            $table->string('editar',2000)->nullable();
            $table->string('eliminar',2000)->nullable();
            $table->string('otros')->nullable();
            $table->string('caja')->nullable();
            $table->string('productos')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
