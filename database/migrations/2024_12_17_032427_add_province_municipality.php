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
        Schema::table('policy_holders', function (Blueprint $table) {
            $table->string('province')->default('NONE');
            $table->string('municipality')->default('NONE');
            $table->string('address')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('policy_holders', function (Blueprint $table) {
            $table->dropColumn('province');
            $table->dropColumn('municipality');
            $table->string('address')->nullable(false)->change();
        });
    }
};
