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
        Schema::table('repo', function (Blueprint $table) {
            $table->string("author")->nullable();
            $table->string("field")->nullable();
            $table->string("subject")->nullable();
            $table->string("project")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('repo', function (Blueprint $table) {
            $table->dropColumn("author");
            $table->dropColumn("field");
            $table->dropColumn("subject");
            $table->dropColumn("project");
        });
    }
};
