<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSportsmanTourTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sportsman_tour', function (Blueprint $table) {
            $table->unsignedBigInteger('sportsman_id');
            $table->unsignedBigInteger('tour_id');

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
        Schema::table('sportsman_tour', function ($table) {
            $table->dropForeign('sportsman_tour_sportsman_id_foreign');
            $table->dropForeign('sportsman_tour_tour_id_foreign');
        });
        Schema::dropIfExists('sportsman_tour');
    }
}
