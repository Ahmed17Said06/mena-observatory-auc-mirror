<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrochuresTable extends Migration
{
    public function up()
    {
        Schema::create('brochures', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('ar_title')->nullable();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('ar_description')->nullable();
            $table->longText('content')->nullable();
            $table->longText('ar_content')->nullable();
            $table->string('image')->nullable();
            $table->string('pdf_file')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('brochures');
    }
}
