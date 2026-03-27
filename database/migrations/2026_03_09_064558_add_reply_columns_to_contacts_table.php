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
        Schema::table('contacts', function (Blueprint $table) {
            Schema::table('contacts', function (Blueprint $table) {
                $table->text('reply')->nullable()->after('message'); // kolom untuk balasan
                $table->timestamp('replied_at')->nullable()->after('reply'); // waktu balas
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn(['reply', 'replied_at']);
        });
    }
};
