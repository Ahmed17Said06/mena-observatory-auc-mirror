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
        Schema::table('policy_briefs', function (Blueprint $table) {
            // Increase the length of ar_pdf and en_pdf columns to handle long file paths
            $table->string('ar_pdf', 500)->nullable()->change();
            $table->string('en_pdf', 500)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('policy_briefs', function (Blueprint $table) {
            $table->string('ar_pdf', 255)->nullable()->change();
            $table->string('en_pdf', 255)->nullable()->change();
        });
    }
};
