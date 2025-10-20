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
       Schema::create('audiences', function (Blueprint $table) {
    $table->id();
    $table->dateTime('date_audience');
    $table->string('salle');
    $table->foreignId('dossier_id')->constrained('dossiers')->onDelete('cascade');
    $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // juge
    $table->timestamps();
});


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audiences');
    }
};
