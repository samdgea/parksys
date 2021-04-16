<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicileEntriesTable extends Migration
{
    public function up()
    {
        Schema::create('vehicile_entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('vehicile_license_plate', 10);
            $table->integer('vehicile_type');
            $table->dateTime('entry_time')->useCurrent();
            $table->dateTime('exit_time')->nullable();
            $table->integer('created_by');
            $table->integer('modified_by')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vehicile_entries');
    }
}
