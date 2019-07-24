<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLovesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('device_id',100)->nullable(false);
            $table->bigInteger('wallpaper_id')->unsigned();
            $table->timestamps();

            $table->foreign('wallpaper_id')->references('id')->on('wallpapers')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loves');
    }
}
