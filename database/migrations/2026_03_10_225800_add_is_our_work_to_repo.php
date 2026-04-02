<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('repo', function (Blueprint $table) {
            $table->boolean('is_our_work')->default(true)->after('project');
        });
    }

    public function down()
    {
        Schema::table('repo', function (Blueprint $table) {
            $table->dropColumn('is_our_work');
        });
    }
};
