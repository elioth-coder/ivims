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
        Schema::create('policy_details', function (Blueprint $table) {
            $table->id();
            $table->string('coc_no')->unique();
            $table->string('policy_no')->unique();
            $table->string('or_no')->unique();
            $table->date('date_issued');
            $table->integer('validity');
            $table->float('premium');
            $table->string('premium_code');
            $table->date('inception_date');
            $table->date('expiry_date');
            $table->integer('policy_holder_id');
            $table->integer('vehicle_detail_id');
            $table->integer('company_id');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('policy_details');
    }
};
