<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    if (!Schema::hasColumn('users', 'status_validasi')) {
        Schema::table('users', function (Blueprint $table) {
            $table->string('status_validasi')
                ->default('pending')
                ->after('is_aktif');
        });
    }
}

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status_validasi');
        });
    }
};