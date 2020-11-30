<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNhomKinhdoanhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhom_kinhdoanhs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->bigInteger('kenh_kd_id')->unsigned()->nullable();
            $table->bigInteger('team_type_id')->unsigned()->nullable();
            $table->integer('order')->nullable()->default(null);
            $table->boolean('active')->nullable()->default(null);
            $table->unsignedBigInteger('created_by')->nullable()->default(null);
            $table->unsignedBigInteger('updated_by')->nullable()->default(null);
            $table->unsignedBigInteger('deleted_by')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('kenh_kd_id')->references('id')->on('kenh_kinhdoanhs')->onDelete('SET NULL')->onUpdate('cascade');
            $table->foreign('team_type_id')->references('id')->on('team_types')->onDelete('SET NULL')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nhom_kinhdoanhs');
    }
}
