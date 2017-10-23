<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('image', 400)->nullable()->default(null);
            $table->string('thumbnail', 400)->nullable()->default(null);
            $table->string('icon', 400)->nullable()->default(null);
            $table->boolean('link_target')->nullable()->default(null);
            NestedSet::columns($table);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            NestedSet::dropColumns($table);
        });
        Schema::dropIfExists('pages');
    }
}
