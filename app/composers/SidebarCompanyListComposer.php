<?php namespace Powerhouse\Core;

class SidebarCompanyListComposer {

	public function compose($view)
	{
		$companies = Company::all();
		$view->with('companies', $companies);
	}

}