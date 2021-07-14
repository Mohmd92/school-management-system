<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsForeignKeys extends Migration {

	public function up()
	{
		Schema::table('sections', function(Blueprint $table) {
			$table->foreign('grade_id')->references('id')->on('grades')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('sections', function(Blueprint $table) {
			$table->foreign('classroom_id')->references('id')->on('classrooms')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('sections', function(Blueprint $table) {
			$table->dropForeign('sections_grade_id_foreign');
		});
		Schema::table('sections', function(Blueprint $table) {
			$table->dropForeign('sections_classroom_id_foreign');
		});
	}
}
