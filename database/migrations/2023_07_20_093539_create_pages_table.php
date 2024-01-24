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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->char('page_title')->index();
            $table->char('page_seotitle')->nullable();
            $table->char('page_slug');
            $table->text('page_desc')->nullable();
            $table->text('page_seodesc')->nullable();
            $table->text('page_content')->nullable();
            $table->char('page_thumb')->nullable();
            $table->tinyInteger('page_status')->default(1)->comment('1:active,0:unactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
