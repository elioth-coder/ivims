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
        Schema::create('vehicle_details', function (Blueprint $table) {
            $table->id();
            $table->string('mv_file_no')->nullable();
            $table->string('plate_no')->nullable();
            $table->string('serial_no');
            $table->string('motor_no');
            $table->string('make');
            $table->string('model');
            $table->string('color');
            $table->string('body_type');
            $table->integer('authorized_cap');
            $table->integer('unladen_weight');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_details');
    }
};
