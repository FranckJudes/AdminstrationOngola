<?php

use App\Models\Partenaires;
use App\Models\User;
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
            Schema::create('partenaires', function (Blueprint $table) {
                $table->id();
                $table->string('nom');
                $table->string('adresse');
                $table->string('type');
                $table->string('cni')->nullable();
                $table->string('logo')->nullable();
                $table->time('heure_ouverture')->nullable();
                $table->time('heure_fermeture')->nullable();
                $table->string('password');
                $table->string('email')->unique();
            });
        Schema::create('partenaire_user', function (Blueprint $table) {
            $table->foreignIdFor(Partenaires::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['partenaires_id','user_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partenaires');
    }
};
