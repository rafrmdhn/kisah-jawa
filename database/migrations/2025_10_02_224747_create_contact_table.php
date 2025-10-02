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
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('name', 120)->after('id');
            $table->string('email', 190)->after('name');
            $table->string('subject', 190)->after('email');
            $table->text('message')->after('subject');
            $table->string('ip', 45)->nullable()->after('message');
            $table->text('user_agent')->nullable()->after('ip');
            $table->boolean('is_read')->default(false)->after('user_agent');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn(['name', 'email', 'subject', 'message', 'ip', 'user_agent', 'is_read']);
        });
    }
};
