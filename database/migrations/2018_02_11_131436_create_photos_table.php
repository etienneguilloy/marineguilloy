<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('libel');
            $table->string('url');
            // $table->string('urlMiniature');
            $table->unsignedTinyInteger('vitrine')->default(0);
            $table->mediumInteger('album_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photos');
    }
}
