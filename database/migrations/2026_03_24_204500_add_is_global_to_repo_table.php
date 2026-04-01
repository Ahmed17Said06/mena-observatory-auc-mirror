<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsGlobalToRepoTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('repo', function (Blueprint $table) {
            $table->boolean('is_global')->default(false)->nullable()->after('is_our_work');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('repo', function (Blueprint $table) {
            $table->dropColumn('is_global');
        });
    }
}
