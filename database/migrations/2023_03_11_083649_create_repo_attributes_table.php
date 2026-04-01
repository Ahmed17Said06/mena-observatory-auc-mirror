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
        Schema::create('repo_attributes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('key');
            $table->unsignedBigInteger('value_id');
            $table->foreignId('repo_id')->constrained('repo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repo_attributes');
    }
};
