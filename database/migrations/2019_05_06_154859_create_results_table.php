<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('contest_id')->nullable();
            $table->unsignedBigInteger('sportsman_id');
            $table->unsignedBigInteger('tour_id')->nullable();
            $table->integer('haul')->nullable();
            $table->integer('point')->nullable();
            $table->tinyInteger('type');

            $table->timestamps();

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

            $table->foreign('tour_id')
                ->references('id')
                ->on('tours')
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
        Schema::table('results', function ($table) {
            $table->dropForeign('results_contest_id_foreign');
            $table->dropForeign('results_sportsman_id_foreign');
            $table->dropForeign('results_tour_id_foreign');
        });

        Schema::dropIfExists('results');
    }
}
