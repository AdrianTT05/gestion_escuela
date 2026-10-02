<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('modulos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 10)->unique();
            $table->string('nombre', 100);
            $table->string('curso', 10);
            $table->string('profesor', 100);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modulos');
    }
};
