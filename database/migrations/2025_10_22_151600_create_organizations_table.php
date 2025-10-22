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
        Schema::create('organizations', function (Blueprint $table) {
            // Sesuai Playbook v2: PK harus UUID
            $table->uuid('id')->primary();

            $table->string('name'); // Nama Organisasi
            $table->uuid('owner_id')->nullable()->index();
            $table->string('status', 50)->default('active')->index();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('owner_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
