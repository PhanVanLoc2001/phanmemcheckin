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
        Schema::table('menu_item', function (Blueprint $table) {
            $table->unsignedBigInteger('item_id')->nullable()->default(0)->change();
        });
    }

    public function down()
    {
        Schema::table('menu_item', function (Blueprint $table) {
            $table->unsignedBigInteger('item_id')->nullable()->change();
        });
    }

};
