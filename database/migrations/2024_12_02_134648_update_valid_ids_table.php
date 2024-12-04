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
        Schema::table('valid_ids', function (Blueprint $table) {
            $table->renameColumn('agency', 'description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('valid_ids', function (Blueprint $table) {
            $table->renameColumn('description', 'agency');
        });
    }
};
