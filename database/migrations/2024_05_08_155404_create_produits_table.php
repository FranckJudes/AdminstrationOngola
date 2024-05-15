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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_partenaire')->constrained('partenaires')->onDelete('cascade');
            $table->string('type')->nullable();//enum('type',['TV/Monitors','PC','Gaming/Console','Phones'])->nullable();
            $table->string('nom');
            $table->integer('quantite');
            $table->decimal('prix', 10, 2); // 10 chiffres au total, 2 chiffres après la virgule
            $table->text('description')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
