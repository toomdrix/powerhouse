<?php namespace Powerhouse\Core;

class ProjectCreateFormComposer {

	public function compose($view)
	{
		$clients = \DB::table('company')->orderBy('name', 'asc')->lists('name','id');
		$view->with('clients', $clients);
	}

}