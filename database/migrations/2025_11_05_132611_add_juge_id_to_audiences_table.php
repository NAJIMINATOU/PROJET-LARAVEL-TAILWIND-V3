<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('audiences', function (Blueprint $table) {
        $table->unsignedBigInteger('juge_id')->nullable()->after('id'); // nullable si pas obligatoire
        $table->foreign('juge_id')->references('id')->on('users')->onDelete('set null');
    });
}
public function down()
{
    Schema::table('audiences', function (Blueprint $table) {
        $table->dropForeign(['juge_id']);
        $table->dropColumn('juge_id');
    });
}

};
