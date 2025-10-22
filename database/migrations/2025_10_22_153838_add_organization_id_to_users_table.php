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
        Schema::table('users', function (Blueprint $table) {
            // Wajib Nullable: Karena 'superadmin' tidak punya organisasi (null)
            $table->uuid('organization_id')
                    ->nullable()
                    ->after('status'); // Posisikan setelah 'status' agar rapi

            // Definisikan Foreign Key ke tabel organizations
            $table->foreign('organization_id')
                    ->references('id')
                    ->on('organizations')
                    ->onDelete('cascade'); // Jika organisasi dihapus, semua user di dalamnya ikut terhapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus foreign key dulu (nama constraint: users_organization_id_foreign)
            $table->dropForeign(['organization_id']);
            // Hapus kolomnya
            $table->dropColumn('organization_id');
        });
    }
};
