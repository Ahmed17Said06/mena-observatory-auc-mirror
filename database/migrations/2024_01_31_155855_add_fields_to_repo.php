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
            $table->string('data_link');
            $table->string('ar_pdf')->nullable();
            $table->string('en_pdf')->nullable();
            $table->dropColumn('content');


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
            //
        });
    }
};
