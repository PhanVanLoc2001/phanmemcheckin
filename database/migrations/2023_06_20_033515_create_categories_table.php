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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('cate_title')->index();
            $table->string('cate_slug')->nullable();
            $table->text('cate_desc')->nullable();
            $table->text('cate_content')->nullable();
            $table->text('cate_thumb')->nullable();
            $table->integer('cate_number')->default(0);
            $table->integer('cate_parent')->default(0);
            $table->string('cate_type',10)->default('post');
            $table->tinyInteger('cate_status')->default(1)->comment('1:active,0:unactive');
            $table->string('cate_template')->nullable()->default('postCate');
            $table->string('cate_lang',10)->default('vi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
