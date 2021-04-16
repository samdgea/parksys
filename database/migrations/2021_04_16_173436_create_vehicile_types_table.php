<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicileTypesTable extends Migration
{
    public function up()
    {
        Schema::create('vehicile_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('vehicile_code', 5);
            $table->string('vehicile_name');
            $table->integer('first_hour_price')->default(5000);
            $table->integer('next_hour_price')->default(5000);
            $table->boolean('is_flat_price')->default(false);
            $table->integer('created_by');
            $table->timestamps();
            $table->integer('updated_by');
        });
    }

    public function down()
    {
        Schema::dropIfExists('vehicile_types');
    }
}
