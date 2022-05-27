<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_team1');
            $table->integer('goals_team1');
            $table->integer('taken_team1');
            $table->integer('points_team1');
            $table->unsignedBigInteger('id_team2');
            $table->integer('goals_team2');
            $table->integer('taken_team2');
            $table->integer('points_team2');
            $table->string('group');
            $table->string('match');
            $table->timestamps();
        });
        Schema::table('matches', function (Blueprint $table) {
            $table->foreign('id_team1')->references('id')->on('teams');
            $table->foreign('id_team2')->references('id')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
};
