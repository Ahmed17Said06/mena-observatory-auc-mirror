<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pw_mena_publications', function (Blueprint $table) {
            $table->text('description')->nullable()->after('ar_title');
            $table->longText('content')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('pw_mena_publications', function (Blueprint $table) {
            $table->dropColumn(['description', 'content']);
        });
    }
};
