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
        Schema::create('dossiers', function (Blueprint $table) {
            $table->id();
            $table->string('numero_dossier')->unique();
            $table->string('type_affaire');
            $table->date('date_depot');
            $table->enum('statut', ['en cours', 'clos', 'en appel'])->default('en cours');
            $table->text('description')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('juge_id')->nullable();
            $table->timestamps();

            // Si tu veux une contrainte de clé étrangère pour juge_id, tu peux ajouter :
            // $table->foreign('juge_id')->references('id')->on('juges')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dossiers');
    }
};
