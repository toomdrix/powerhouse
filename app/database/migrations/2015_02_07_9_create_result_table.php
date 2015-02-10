<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('result', function($table) {
			$table->increments('id');
			$table->integer('quarter');
			$table->integer('year');
			$table->integer('estimated');
			$table->integer('actual');
			$table->integer('project_id')->unsigned();
			$table->foreign('project_id')->references('id')->on('project')->onDelete('cascade');
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
		Schema::drop('result');
	}

}
