<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('author_repo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->nullable()->constrained('authors');
            $table->foreignId('repo_id')->nullable()->constrained('repo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('author_repo');
    }
};
