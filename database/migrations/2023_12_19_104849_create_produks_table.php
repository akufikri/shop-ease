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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('produk_name');
            $table->unsignedBigInteger('kategori_id');
            $table->text('deskripsi');
            $table->decimal('harga', 8, 2);
            $table->integer('stok');
            $table->text('photo_produk');
            $table->date('expired')->nullable();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
