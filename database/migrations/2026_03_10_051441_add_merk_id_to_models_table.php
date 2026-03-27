<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('models', function (Blueprint $table) {
            $table->unsignedBigInteger('merk_id')->after('id'); // tambah kolom merk_id
            $table->foreign('merk_id')->references('id')->on('merks')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('models', function (Blueprint $table) {
            $table->dropForeign(['merk_id']);
            $table->dropColumn('merk_id');
        });
    }
};