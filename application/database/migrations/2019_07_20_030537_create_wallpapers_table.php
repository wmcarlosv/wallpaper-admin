<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWallpapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallpapers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('application_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->string('thumbnail',100)->nullable(false);
            $table->string('wallpaper_url',100)->nullable(false);
            $table->string('tags',200)->nullable();
            $table->timestamps();

            $table->foreign('application_id')->references('id')->on('applications')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallpapers');
    }
}
