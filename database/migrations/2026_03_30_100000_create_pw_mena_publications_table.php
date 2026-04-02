<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePwMenaPublicationsTable extends Migration
{
    public function up()
    {
        Schema::create('pw_mena_publications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('ar_title')->nullable();
            $table->enum('type', ['report', 'brief', 'blog'])->default('report');
            $table->string('tag', 100)->nullable();
            // link_en/ar/fr: paste a URL (https://...) or a server-relative path (/docs/egypt/file.pdf)
            // Uploaded files via Filament are stored as bare filenames in the public disk
            $table->string('link_en', 500)->nullable();
            $table->string('link_ar', 500)->nullable();
            $table->string('link_fr', 500)->nullable();
            // external_link: used when the whole card links to one URL (blogs, single-language reports)
            $table->string('external_link', 500)->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pw_mena_publications');
    }
}
