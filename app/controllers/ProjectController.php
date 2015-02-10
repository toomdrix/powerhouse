<?php namespace Powerhouse\Core;

class ProjectController extends BaseController {

	public function index()
	{

		$list = \View::make('common/list');
		$list->items = Project::paginate(Configuration::find('num_list_items')->value);

		$this->layout->content = $list;

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$form = \View::make('project.form');
		$form->action = array('action' => 'Powerhouse\Core\ProjectController@store', 'class'=>'form-signup');
		return $form;
	}

	public function destroy($id)
	{
		$project = Project::find($id);
		$project->delete();
		exit;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$project = Project::find($id);

		\Session::put('active_project', $project->id);

		$this->layout->title = $project->name;

		$overview = $project->getOverview();
		$overview->title = "Estimated vs Actual Costs";

		$results = \View::make('common/list');
		$results->items =  $project->results()->orderby('year')->orderby('quarter')->get();

		$view = \View::make('common.tabs');
		$view->tabs = array(
				'Overview' => $overview,
				'Results and Projections' => $results,
				'People' => 'Users'
			);

		$this->layout->sidebar = \View::make('block.sidebar.project.list');
		$this->layout->content = $view;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if (!$this->validate()) {
			return $this->getRedirect()
			->withErrors($this->validator)
			->withInput(\Input::except('password'));
		} else {

			// store
			$project = new Project;
			$project->name  = PWR::getClean('name');
			$project->company_id = PWR::getClean('company_id');
			$project->save();

			// redirect
			\Flash::push('success', 'Successfully created project!');

			return $this->getRedirect();
		}
	}

	private function validate($update = false) {
		$rules = array(
			'name'  => 'required',
			'company_id'  => 'required',
			);

		$this->validator = \Validator::make(\Input::all(), $rules);

		// process the login
		return !$this->validator->fails();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$form = \View::make('project.form');
		$form->project = Project::find($id);
		$form->action = array('action' => array('Powerhouse\Core\ProjectController@update', $form->project->id),'class'=>'form-signup');
		return $form;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if (!$this->validate(true)) {
			return $this->getRedirect()
			->withErrors($this->validator)
			->withInput(\Input::except('password'));
		} else {
			// store
			$project = Project::find($id);
			$project->name  = PWR::getClean('name');
			$project->company_id = PWR::getClean('company_id');
			$project->save();

			// redirect
			\Flash::push('success', 'Successfully updated project!');
			return $this->getRedirect();
		}
	}

}
