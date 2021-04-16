<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUniqueCode extends Migration
{
    public function up()
    {
        Schema::table('vehicile_entries', function (Blueprint $table) {
            $table->string('gatekeeper_code', 25)->unique()->after('id');
        });
    }

    public function down()
    {
        Schema::table('vehicile_entries', function (Blueprint $table) {
            $table->dropColumn('gatekeeper_code');
        });
    }
}
