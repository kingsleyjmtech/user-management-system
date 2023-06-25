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
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->unique();
            $table->boolean('active')->default(false);
            $table->boolean('terms_accepted')->default(false);
            $table->unsignedBigInteger('creator_id')->nullable();
            $table->string('slug')->unique();

            $table->foreign('creator_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('phone');
            $table->dropColumn('active');
            $table->dropColumn('terms_accepted');
            $table->dropForeign(['creator_id']);
            $table->dropColumn('creator_id');
            $table->dropColumn('slug');
        });
    }
};
