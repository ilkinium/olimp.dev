<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlideTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slide_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('slide_id')->unsigned();
            $table->string('title1', 400)->nullable()->default(null);
            $table->string('title2', 400)->nullable()->default(null);
            $table->string('title3', 400)->nullable()->default(null);
            $table->string('lang', 5)->default('az');
            $table->timestamps();
            $table->foreign('slide_id')->references('id')->on('slides')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('slide_translations', function (Blueprint $table) {
            $table->dropForeign('slide_id');
        });
        Schema::dropIfExists('slide_translations');
    }
}
