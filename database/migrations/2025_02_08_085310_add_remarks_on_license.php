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
            $table->string('remarks')->after('expiry_date')->nullable();
        });
        Schema::table('branches', function (Blueprint $table) {
            $table->string('remarks')->after('expiry_date')->nullable();
        });
        Schema::table('companies', function (Blueprint $table) {
            $table->string('remarks')->after('expiry_date')->nullable();
        });
        Schema::table('licenses', function (Blueprint $table) {
            $table->string('remarks')->after('expiry_date')->nullable();
            $table->string('status')->after('remarks')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('remarks');
        });
        Schema::table('branches', function (Blueprint $table) {
            $table->dropColumn('remarks');
        });
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('remarks');
        });
        Schema::table('licenses', function (Blueprint $table) {
            $table->dropColumn('remarks');
            $table->dropColumn('status');
        });
    }
};
