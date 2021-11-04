<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThemeOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theme_option', function (Blueprint $table) {
            $table->id();
            $table->string('site_name');
            $table->string('logo');
            $table->string('favicon');
            $table->string('footer_logo')->nullable();
            $table->string('address');
            $table->string('hotline')->nullable();
            $table->string('email')->nullable();
            $table->string('facebook')->nullable();
            $table->string('google')->nullable();
            $table->string('zalo')->nullable();
            $table->string('skype')->nullable();
            $table->string('youtube')->nullable();

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
        Schema::dropIfExists('theme_option');
    }
}
