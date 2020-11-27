<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamLeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_leaders_table', function (Blueprint $table) {
            $table->string('leader_mnv', 10);
            $table->foreign('leader_mnv')->references('mnv')->on('bfo_infos')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('team_id')->unsigned();
            $table->primary(['leader_mnv', 'team_id']);
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_leaders_table');
    }
}
