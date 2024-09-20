<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();

            $table->string("nombres", 50);
            $table->string("apellidos", 50)->nullable();
            $table->string("ci", 20)->nullable();
            $table->string("direccion")->nullable();
            $table->string("telefono")->nullable();

            $table->unsignedBigInteger("unidad_id");
            $table->foreign("unidad_id")->references("id")->on("unidads");

            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign("user_id")->references("id")->on("users");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
