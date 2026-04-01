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
        Schema::table('policy_briefs', function (Blueprint $table) {
            // Drop old columns first
            $table->dropColumn([
                'ar_title', 
                'ar_description', 
                'file_path', 
                'image_path', 
                'published_at'
            ]);
            
            // Add new columns to match repo structure exactly
            $table->string('image')->after('description');
            $table->date('publish_date')->nullable()->after('image');
            $table->unsignedBigInteger('country_id')->after('publish_date');
            $table->string('repo_type_id')->nullable()->after('country_id');
            $table->integer('views')->default(0)->after('repo_type_id');
            $table->string('data_link')->nullable()->after('views');
            $table->string('ar_pdf')->nullable()->after('data_link');
            $table->string('en_pdf')->nullable()->after('ar_pdf');
            $table->string('author')->nullable()->after('en_pdf');
            $table->string('field')->nullable()->after('author');
            $table->string('subject')->nullable()->after('field');
            $table->string('project')->nullable()->after('subject');
            
            // Add foreign key constraint
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('policy_briefs', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['country_id']);
            
            // Drop new columns
            $table->dropColumn([
                'image', 'publish_date', 'country_id', 'repo_type_id', 'views',
                'data_link', 'ar_pdf', 'en_pdf', 'author', 'field', 'subject', 'project'
            ]);
            
            // Restore old columns
            $table->string('ar_title')->after('title');
            $table->text('ar_description')->after('description');
            $table->string('file_path')->after('ar_description');
            $table->string('image_path')->after('file_path');
            $table->timestamp('published_at')->nullable()->after('image_path');
        });
    }
};
