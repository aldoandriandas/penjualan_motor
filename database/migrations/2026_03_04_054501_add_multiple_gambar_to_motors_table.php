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
        Schema::table('motors', function (Blueprint $table) {
            $table->string('gambar2')->nullable()->after('gambar');
            $table->string('gambar3')->nullable()->after('gambar2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('motors', function (Blueprint $table) {
            $table->dropColumn(['gambar2', 'gambar3']);
        });
    }
};
