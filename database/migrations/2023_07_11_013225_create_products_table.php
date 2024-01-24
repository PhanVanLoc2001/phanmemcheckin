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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('prod_name')->index();
            $table->string('prod_slug');
            $table->text('prod_desc')->nullable();
            $table->text('prod_content')->nullable();
            $table->string('prod_seotitle')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->string('prod_thumb')->nullable();
            $table->string('prod_excerpt')->nullable();
            $table->string('prod_library')->nullable();
            $table->string('prod_template')->default('productSingle');
            $table->tinyInteger('prod_status')->default(1)->comment('1:active,0:unactive');
            $table->tinyInteger('prod_spin')->default(0)->comment('1:ghim,0:không ghim');
            $table->integer('prod_price');
            $table->integer('prod_saleprice')->nullable();
            $table->json('prod_attributes')->nullable();
            $table->string('prod_feature')->nullable();
            $table->string('prod_background')->nullable();
            $table->string('download')->nullable();
            $table->string('update')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
