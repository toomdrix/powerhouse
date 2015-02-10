<?php namespace Powerhouse\Core;

class ResultCreateFormComposer {

	public function compose($view)
	{
		$projects = \DB::table('project')->orderBy('name', 'asc')->lists('name','id');
		$view->with('projects', $projects);
	}

}