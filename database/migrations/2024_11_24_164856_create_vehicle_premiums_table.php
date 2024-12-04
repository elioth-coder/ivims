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
        Schema::create('vehicle_premiums', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('type')->unique();
            $table->float('one_year');
            $table->float('three_years');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_premiums');
    }
};
