<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserGroupLink extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table) {
			$table->integer('usergroup_id')->unsigned();
			$table->foreign('usergroup_id')->references('id')->on('usergroup');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function($table) {
			$table->dropForeign('users_usergroup_id_foreign');
            $table->dropColumn('usergroup_id');
        });
	}

}
