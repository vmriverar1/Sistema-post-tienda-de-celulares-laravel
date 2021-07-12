<?php

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('categoria_id')->nullable();
            $table->string('subcategoria_id')->nullable();
            $table->integer('almacen')->nullable();
            $table->string('imei',5000)->nullable();
            $table->string('estado')->nullable();
            $table->integer('stock')->default("0");
            $table->string('brand')->nullable();
            $table->string('cod_prod')->nullable();
            $table->enum('tipoprecio', [Product::FIJO, Product::CAMBIANTE])->default(Product::FIJO);
            $table->decimal('precio',18,2)->default("0");
            $table->integer('minimomayor')->default("0");
            $table->decimal('preciomayor',18,2)->default("0");
            $table->decimal('costo',18,2)->default("0");
            $table->string('tipo')->nullable();
            $table->string('multimedia',6000)->nullable();
            $table->string('foto')->nullable();
            $table->integer('ventas')->nullable();
            $table->string('color')->nullable();
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
        Schema::dropIfExists('products');
    }
}
