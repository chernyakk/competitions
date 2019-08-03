<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSummaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('summary', function (Blueprint $table) {
            $table->unsignedBigInteger('contest_id')->nullable();
            $table->unsignedBigInteger('sportsman_id')->nullable();
            $table->integer('hauls')->nullable();
            $table->integer('points')->nullable();

            $table->foreign('contest_id')
                ->references('id')
                ->on('contests')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table->foreign('sportsman_id')
                ->references('id')
                ->on('sportsmen')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('summary', function ($table) {
            $table->dropForeign('summary_contest_id_foreign');
            $table->dropForeign('summary_sportsman_id_foreign');
        });
        Schema::dropIfExists('summary');
    }
}
