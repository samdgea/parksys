<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationConfigurationTable extends Migration
{
    public function up()
    {
        Schema::create('config', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('config_name');
            $table->longText('config_value')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('config');
    }
}
