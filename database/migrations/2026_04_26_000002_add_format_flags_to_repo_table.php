<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('repo', function (Blueprint $table) {
            $table->boolean('is_research')->nullable()->default(false)->after('is_global');
            $table->boolean('is_talk_webinar')->nullable()->default(false)->after('is_research');
            $table->index(['is_research', 'is_talk_webinar']);
        });
    }

    public function down(): void
    {
        Schema::table('repo', function (Blueprint $table) {
            $table->dropIndex(['is_research', 'is_talk_webinar']);
            $table->dropColumn(['is_research', 'is_talk_webinar']);
        });
    }
};
