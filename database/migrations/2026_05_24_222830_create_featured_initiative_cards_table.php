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
        Schema::create('featured_initiative_cards', function (Blueprint $table) {
            $table->id();
            $table->string('label_en');
            $table->string('label_ar')->nullable();
            $table->string('sub_label_en')->nullable();
            $table->string('sub_label_ar')->nullable();
            $table->string('image')->nullable();
            $table->string('title_en');
            $table->string('title_ar')->nullable();
            $table->string('link');
            $table->boolean('link_external')->default(false);
            $table->string('button_text_en');
            $table->string('button_text_ar')->nullable();
            $table->string('button_icon')->default('fa-plus');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('featured_initiative_cards');
    }
};
