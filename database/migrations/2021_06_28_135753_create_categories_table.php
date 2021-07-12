<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('titular');
            $table->string('descripcion',2000);
            $table->integer('estado')->default("1");
            $table->string('foto')->default("images/default/prod-anonymous.png");
            $table->integer('orden_menu')->nullable();
            $table->integer('orden_catalogo')->nullable();
            $table->string('complementos')->nullable();
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
        Schema::dropIfExists('categories');
    }
}
