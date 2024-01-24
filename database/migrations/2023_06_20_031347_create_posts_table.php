<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->char('post_title')->index();
            $table->char('post_seotitle')->nullable();
            $table->char('post_slug');
            $table->text('post_desc')->nullable();
            $table->text('post_seodesc')->nullable();
            $table->text('post_content')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->char('post_thumb')->nullable();
            $table->text('post_library')->nullable();
            $table->tinyInteger('post_status')->default(1)->comment('1:active,0:unactive');
            $table->tinyInteger('post_spinned')->default(0)->comment('1:ghim,0:không ghim');
            $table->text('post_keyword')->nullable();
            $table->char('post_lang',10)->default('vi');
            $table->char('post_templates')->nullable()->default('postSingle');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
