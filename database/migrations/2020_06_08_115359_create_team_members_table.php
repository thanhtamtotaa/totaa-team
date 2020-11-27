<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_members_table', function (Blueprint $table) {
            $table->string('member_mnv', 10);
            $table->foreign('member_mnv')->references('mnv')->on('bfo_infos')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('team_id')->unsigned();
            $table->primary(['member_mnv', 'team_id']);
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
        Schema::dropIfExists('team_members_table');
    }
}
