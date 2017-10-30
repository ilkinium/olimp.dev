<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('banner_id')->unsigned();
            $table->string('title', 400)->nullable()->default(null);
            $table->string( 'lang', 5 )->default( 'az' );
            $table->timestamps();
            $table->foreign( 'banner_id' )->references( 'id' )->on( 'banners' )->onDelete( 'cascade' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banner_translations');
    }
}
