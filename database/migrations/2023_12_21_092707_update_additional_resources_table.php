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
        Schema::table('additional_resources', function (Blueprint $table) {
            $table->dropColumn('content');
            $table->dropColumn('file');
            $table->string('data_link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('additional_resources', function (Blueprint $table) {
            $table->text('content');
            $table->string('file');
            $table->dropColumn('data_link');
        });
    }
};
