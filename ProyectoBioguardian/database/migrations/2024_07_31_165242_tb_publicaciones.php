<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_publicaciones', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_usuario');
            $table->string('titulo');
            $table->text('comentario'); // Cambiado de 'string' a 'text'
            $table->date('fecha');
            $table->string('foto_publi')->nullable(); // Cambiado de 'binary' a 'string'
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_publicaciones');
    }
};
