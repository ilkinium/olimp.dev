<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slides', function (Blueprint $table) {
            $table->increments('id');
            $table->string( 'image', 400 )->nullable()->default( null );
            $table->string( 'thumbnail', 400 )->nullable()->default( null );
            $table->string( 'link', 400 )->nullable()->default( null );
            $table->boolean( 'link_target' )->nullable()->default( null );
            $table->unsignedTinyInteger( 'order' )->nullable()->default( null );
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
        Schema::dropIfExists('slides');
    }
}
