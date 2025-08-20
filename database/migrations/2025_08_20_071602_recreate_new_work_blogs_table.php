<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Drop the existing table
        Schema::dropIfExists('new_work_blogs');
        
        // Create new table with exact Blogs structure
        Schema::create('new_work_blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->longText('content');
            $table->string('image')->nullable();
            $table->date('publish_date');
            $table->foreignId('country_id')->constrained('countries');
            $table->integer('views')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('new_work_blogs');
    }
};
