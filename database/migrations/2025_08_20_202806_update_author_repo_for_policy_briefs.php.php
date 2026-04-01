<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('author_repo', function (Blueprint $table) {
            // Add nullable policy_brief_id column
            $table->unsignedBigInteger('policy_brief_id')->nullable()->after('repo_id');
            
            // Add foreign key for policy briefs
            $table->foreign('policy_brief_id')->references('id')->on('policy_briefs')->onDelete('cascade');
            
            // Make repo_id nullable since we can have either repo OR policy_brief
            $table->unsignedBigInteger('repo_id')->nullable()->change();
            
            // Add a check constraint to ensure either repo_id or policy_brief_id is set, but not both
            $table->index(['author_id', 'repo_id', 'policy_brief_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('author_repo', function (Blueprint $table) {
            $table->dropForeign(['policy_brief_id']);
            $table->dropColumn('policy_brief_id');
            $table->unsignedBigInteger('repo_id')->nullable(false)->change();
        });
    }
};
