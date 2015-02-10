<?php namespace Powerhouse\Core;

class DashboardController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$this->layout->sidebar = \View::make('block.sidebar.project.list');

		$clients = PWR::getClean('clients');

		$project = \App::make('\Powerhouse\Core\Project');
		$results = $project->getAllResults($clients);
		$real_estimated = $project->getRealEstimatedLineChart($results);

    	$table = \View::make('common/list_minimal');
		$table->items =  $results;

		$overview = \View::make('project/overview');
		$overview->title = "Estimated vs Actual Costs (All Projects)";
		$overview->clients = Company::select('name','id')->get();
		$overview->charts = array(
			$real_estimated,
			$table
		);

		if (\Request::ajax())
		{
			echo $overview;
			exit;		
		} else {
			$this->layout->content = $overview;
		}

	}

	private function getOverview($clients = null) {
		$project = new \Powerhouse\Core\Project();

		




		return $overview;
	}

}
