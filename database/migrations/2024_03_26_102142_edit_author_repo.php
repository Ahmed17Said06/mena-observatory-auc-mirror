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
            $table->dropForeign(['author_id']);
            $table->dropForeign(['repo_id']);

            $table->foreignId('author_id')->change()->nullable()->constrained('authors')->cascadeOnDelete();
            $table->foreignId('repo_id')->change()->nullable()->constrained('repo')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
