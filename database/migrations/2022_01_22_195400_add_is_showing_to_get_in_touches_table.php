<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsShowingToGetInTouchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('get_in_touches', function (Blueprint $table) {
            $table->boolean('is_showing')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('get_in_touches', function (Blueprint $table) {
            $table->dropColumn('is_showing');
        });
    }
}
