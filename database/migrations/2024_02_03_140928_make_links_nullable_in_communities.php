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
        Schema::table('communities', function (Blueprint $table) {
            $table->string('twitter_link')->nullable()->change();
            $table->string('facebook_link')->nullable()->change();
            $table->string('linkedin_link')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('communities', function (Blueprint $table) {
            $table->string('twitter_link')->change();
            $table->string('facebook_link')->change();
            $table->string('linkedin_link')->change();
        });
    }
};
