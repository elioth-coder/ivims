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
            $table->string('first_name')->after('id');
            $table->string('middle_name')->after('id')->nullable();
            $table->string('last_name')->after('id');
            $table->string('suffix')->after('id')->nullable();
            $table->string('gender')->after('id');
            $table->date('birthday')->after('id');
            $table->string('contact_no')->after('id')->nullable();
            $table->integer('company_id')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('first_name');
            $table->dropColumn('middle_name');
            $table->dropColumn('last_name');
            $table->dropColumn('suffix');
            $table->dropColumn('gender');
            $table->dropColumn('birthday');
            $table->dropColumn('contact_no');
            $table->dropColumn('company_id');
        });
    }
};
