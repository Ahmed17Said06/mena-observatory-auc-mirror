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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->datetime('start_date');
            $table->datetime('end_date')->nullable();
            $table->string('title');
            $table->text('description');
            $table->text('location');
            $table->text('gmaps_url')->nullable();
            $table->enum('type', ['Online', 'In Person', 'Hybrid'])->default('In Person');
            $table->string('image');
            $table->enum('featured', ['no', 'yes'])->default('no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};
