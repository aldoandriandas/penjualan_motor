<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Menambah option 'super_admin' di enum role
        DB::statement("
            ALTER TABLE users 
            MODIFY role ENUM('super_admin','admin','user','sales') NOT NULL DEFAULT 'user'
        ");
    }

    public function down(): void
    {
        // Kembali ke enum lama jika rollback
        DB::statement("
            ALTER TABLE users 
            MODIFY role ENUM('admin','user','sales') NOT NULL DEFAULT 'user'
        ");
    }
};