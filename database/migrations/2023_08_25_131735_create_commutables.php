<?php

use App\Models\Community;
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
        Schema::create('commutables', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(model: Community::class)->constrained()->onDelete('cascade');
            $table->morphs('commutable');
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
        Schema::dropIfExists('commutables');
    }
};
