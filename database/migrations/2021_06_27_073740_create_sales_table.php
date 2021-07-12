<?php

use App\Models\Sale;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('trabajador');
            $table->string('caja');
            $table->string('cliente')->default("Anonimo");
            $table->string('nota')->nullable();
            $table->enum('tipo', [Sale::TIENDA, Sale::ONLINE, Sale::DELIVERY])->default(Sale::TIENDA);
            $table->string('pedido');
            $table->decimal('subtotal',18,2);
            $table->enum('tipo_descuento', [Sale::NORMAL, Sale::PROMOCION, Sale::CUPON, Sale::NINGUNO])->default(Sale::NINGUNO);
            $table->decimal('descuento',18,2)->default("0");
            $table->decimal('igv',18,2)->default("0");
            $table->decimal('vuelto',18,2)->default("0");
            $table->decimal('total',18,2);
            $table->string('cod_pago')->nullable();
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
        Schema::dropIfExists('sales');
    }
}
