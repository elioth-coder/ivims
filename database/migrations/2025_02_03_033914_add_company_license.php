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
        Schema::table('companies', function (Blueprint $table) {
            $table->integer('license_duration')->after('address')->nullable();
            $table->date('start_date')->after('license_duration')->nullable();
            $table->date('expiry_date')->after('start_date')->nullable();
            $table->string('status')->after('expiry_date')->default('new');
        });

        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->integer('license_duration');
            $table->date('start_date');
            $table->date('expiry_date');
            $table->string('type');
            $table->integer('entity_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('license_duration');
            $table->dropColumn('start_date');
            $table->dropColumn('expiry_date');
            $table->dropColumn('status');
        });

        Schema::dropIfExists('licenses');
    }
};
