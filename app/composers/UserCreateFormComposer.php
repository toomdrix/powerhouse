<?php namespace Powerhouse\Core;

class UserCreateFormComposer {

	public function compose($view)
	{
		$clients = \DB::table('company')->orderBy('name', 'asc')->lists('name','id');
		$view->with('clients', $clients);

		$usergroups = \DB::table('usergroup')->orderBy('name', 'asc')->lists('name','id');
		$view->with('usergroups', $usergroups);
	}

}