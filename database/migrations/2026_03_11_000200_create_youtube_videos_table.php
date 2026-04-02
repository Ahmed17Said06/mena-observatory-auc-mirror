<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('youtube_videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('ar_title')->nullable();
            $table->string('youtube_url');
            $table->text('description')->nullable();
            $table->text('ar_description')->nullable();
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('youtube_videos');
    }
};
