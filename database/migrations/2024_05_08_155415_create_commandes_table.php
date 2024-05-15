<?php

use App\Models\Commande;
use App\Models\Produit;
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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id(); // clé primaire non entière
            $table->string('type_livraison')->nullable();
            $table->decimal('totaux');
            $table->foreignId('id_receive_client')->constrained('receive_clients')->onDelete('cascade'); //id du partenaire
            $table->foreignId('id_partenaire')->constrained('partenaires')->onDelete('cascade'); //id du partenaire
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('commande_produit', function (Blueprint $table) {
            $table->foreignIdFor(Commande::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Produit::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['commande_id','produit_id']);
            $table->integer('quantite');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
