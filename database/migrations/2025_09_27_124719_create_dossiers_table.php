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
    {Schema::create('dossiers', function (Blueprint $table) {
    $table->id(); // devient "id"
    $table->string('numero_dossier')->unique();
    $table->string('type_affaire');
    $table->date('date_depot');
    $table->enum('statut', ['en cours', 'clos', 'en appel'])->default('en cours');
    $table->text('description')->nullable();
    $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
    $table->timestamps();
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
