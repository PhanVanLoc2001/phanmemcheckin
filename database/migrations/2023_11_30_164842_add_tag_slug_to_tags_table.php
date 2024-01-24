<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTagSlugToTagsTable extends Migration
{
    public function up()
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->string('tag_slug')->unique()->after('tag_name');
        });
    }

    // Phương thức down nếu bạn muốn rollback thay đổi
    public function down()
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->dropColumn('tag_slug');
        });
    }
}
