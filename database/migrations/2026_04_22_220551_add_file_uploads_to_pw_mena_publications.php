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
        Schema::table('pw_mena_publications', function (Blueprint $table) {
            $table->string('file_en', 500)->nullable()->after('link_en');
            $table->string('file_ar', 500)->nullable()->after('link_ar');
            $table->string('file_fr', 500)->nullable()->after('link_fr');
        });
    }

    public function down()
    {
        Schema::table('pw_mena_publications', function (Blueprint $table) {
            $table->dropColumn(['file_en', 'file_ar', 'file_fr']);
        });
    }
};
