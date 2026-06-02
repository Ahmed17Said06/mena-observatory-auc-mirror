<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('repo', function (Blueprint $table) {
            $table->boolean('is_educational')->nullable()->default(false)->after('is_talk_webinar');
            $table->index('is_educational');
        });
    }

    public function down(): void
    {
        Schema::table('repo', function (Blueprint $table) {
            $table->dropIndex(['is_educational']);
            $table->dropColumn('is_educational');
        });
    }
};
