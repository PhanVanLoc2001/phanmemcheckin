<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('recruitments', function (Blueprint $table) {
            $table->id();
            $table->string('rec_title');
            $table->string('rec_slug');
            $table->text('rec_desc')->nullable();
            $table->text('rec_content')->nullable();
            $table->string('rec_thumb')->nullable();
            $table->string('rec_seotitle')->nullable();
            $table->text('rec_seodesc')->nullable();
            $table->tinyInteger('rec_spin')->nullable()->default(0)->comment('1:ghim,0:không ghim');;
            $table->tinyInteger('rec_status')->nullable()->default(1)->comment('1:active,0:unactive');;
            $table->integer('rec_quantity')->nullable();
            $table->string('rec_time')->nullable();
            $table->string('rec_money')->nullable();
            $table->string('rec_department')->nullable();
            $table->string('rec_template')->nullable()->default('recruitment');
            $table->string('rec_workplace')->nullable();
            $table->tinyInteger('rec_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recruitments');
    }
};
