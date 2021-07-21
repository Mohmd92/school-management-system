<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentsForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parents', function (Blueprint $table) {
            $table->foreign('father_nationality_id')->references('id')->on('nationalities');
            $table->foreign('father_blood_type_id')->references('id')->on('blood_types');
            $table->foreign('mother_nationality_id')->references('id')->on('nationalities');
            $table->foreign('mother_blood_type_id')->references('id')->on('blood_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parents', function(Blueprint $table) {
            $table->dropForeign('parents_father_nationality_id_foreign');
//            $table->dropIndex('parents_father_nationality_id_foreign');
        });
        Schema::table('parents', function(Blueprint $table) {
            $table->dropForeign('parents_father_blood_type_id_foreign');
        });
        Schema::table('parents', function(Blueprint $table) {
            $table->dropForeign('parents_mother_nationality_id_foreign');
        });
        Schema::table('parents', function(Blueprint $table) {
            $table->dropForeign('parents_mother_blood_type_id_foreign');
        });
    }
}
