<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->enum('role', [User::ADMIN, User::USUARIO, User::CAJA, User::ENGARGADO])->default(User::USUARIO);
            $table->string('estado')->default("0");
            $table->string('stores')->nullable();
            $table->string('foto')->nullable();
            $table->string('direccion')->nullable();
            $table->string('celular')->nullable();
            $table->string('dni')->nullable();
            $table->string('store')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
