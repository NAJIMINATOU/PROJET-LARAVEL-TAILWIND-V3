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
        Schema::create('courriers', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->enum('type', ['entrant', 'sortant']);
            $table->date('date_courrier');
            $table->string('expediteur');
            $table->string('destinataire');
            $table->foreignId('dossier_id')->nullable()->constrained('dossiers')->onDelete('set null');
            $table->string('fichier')->nullable(); // fichier joint (pdf, doc, etc.)
            $table->enum('status', ['en_cours', 'traite', 'archive'])->default('en_cours');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courriers');
    }
};
