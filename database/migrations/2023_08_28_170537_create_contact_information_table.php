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
        Schema::create('contact_information', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_number')->nullable();
            $table->string('phone_link')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('hcm_link')->nullable();
            $table->string('messenger_link')->nullable();
            $table->string('zalo_link')->nullable();
            $table->string('group_link')->nullable();
            $table->string('tiktok_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('map_link')->nullable();
            $table->text('list_phone')->nullable();
            $table->text('code_header')->nullable();
            $table->text('code_footer')->nullable();
            $table->text('contact_single')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_information');
    }
};
