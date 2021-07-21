<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');

            //Father Information
            $table->string('father_name');
            $table->string('father_id');
            $table->string('father_mobile');
            $table->string('father_job');
            $table->bigInteger('father_nationality_id')->unsigned();
            $table->bigInteger('father_blood_type_id')->unsigned();
            $table->string('father_address');

            //Mother information
            $table->string('mother_name');
            $table->string('mother_id');
            $table->string('mother_mobile');
            $table->string('mother_job');
            $table->bigInteger('mother_nationality_id')->unsigned();
            $table->bigInteger('mother_blood_type_id')->unsigned();
            $table->string('mother_address');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parents');
    }
}
