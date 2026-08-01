<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Adds Arabic counterparts to the People (communities) content columns so the
 * Arabic site can show approved translations of names and bios. Left nullable:
 * a null Arabic value means "not translated / not approved yet", and the views
 * fall back to the English column.
 *
 *   name_ar        <- الأسماء       (Arabic name)
 *   description_ar <- نبذة مختصرة    (Arabic short bio)  — TEXT to match EN description
 *   content_ar     <- نبذة كاملة     (Arabic long bio)
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('communities', function (Blueprint $table) {
            $table->string('name_ar')->nullable()->after('name');
            $table->text('description_ar')->nullable()->after('description');
            $table->text('content_ar')->nullable()->after('content');
        });
    }

    public function down(): void
    {
        Schema::table('communities', function (Blueprint $table) {
            $table->dropColumn(['name_ar', 'description_ar', 'content_ar']);
        });
    }
};
