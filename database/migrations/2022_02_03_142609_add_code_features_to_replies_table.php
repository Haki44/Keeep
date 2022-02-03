<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCodeFeaturesToRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('replies', function (Blueprint $table) {
            $table->smallInteger('starting_code')->nullable()->before('created_at');
            $table->smallInteger('ending_code')->nullable()->before('created_at');
            $table->tinyInteger('starting_code_count')->nullable()->before('created_at');
            $table->tinyInteger('ending_code_count')->nullable()->before('created_at');
            $table->dateTime('started_at')->nullable()->before('created_at');
            $table->dateTime('ended_at')->nullable()->before('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('replies', function (Blueprint $table) {
            //
        });
    }
}
