<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->integer('userId');
            $table->string('name');
            $table->longText('desc')->default('No Description');
            $table->string('banner')->default('images/default/banner.png');
            $table->string('url')->default('https://metin2toplist.eu/');
            $table->string('lang')->default('de|en');
            $table->integer('level')->default(0);
            $table->integer('rates')->default(0);
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
        Schema::dropIfExists('server');
    }
}
