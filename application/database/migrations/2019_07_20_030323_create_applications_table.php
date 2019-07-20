<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('name',120)->nullable(false);
            $table->text('description');
            $table->string('icon',100)->nullable();
            $table->string('current_version',10)->nullable(false);
            $table->string('author',160)->nullable(false);
            $table->string('email',150)->nullable(false);
            $table->text('website')->nullable(false);
            $table->string('phone',25)->nullable(false);
            $table->text('about')->nullable(false);
            $table->text('privacy')->nullable(false);
            $table->text('dev_play_url')->nullable(false);
            $table->string('publisher_id',100)->nullable(false);
            $table->string('banner_id',100)->nullable(false);
            $table->string('interstitial_id',100)->nullable(false);
            $table->integer('interstitial_clicks')->nullable(false);
            $table->string('one_signal_app_id',100)->nullable(false);
            $table->string('one_signal_rest_key',100)->nullable(false);
            $table->string('api_key',160)->nullable();
            $table->enum('status',['online','offline'])->default('online');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
