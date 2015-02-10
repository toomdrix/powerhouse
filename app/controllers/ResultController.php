<?php namespace Powerhouse\Core;

class ResultController extends BaseController {

	public function index()
	{

		$list = \View::make('common/list');
		$list->items = Result::paginate(Configuration::find('num_list_items')->value);

		$this->layout->content = $list;

		//$this->layout->sidebar = View::make('block.sidebar.result.categories');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$form = \View::make('result.form');
		$form->action = array('action' => 'Powerhouse\Core\ResultController@store', 'class'=>'form-signup');
		return $form;
	}

	public function destroy($id)
	{
		$result = Result::find($id);
		$result->delete();
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
		$result = Result::find($id);

		\Session::put('active_result', $result->id);

		$this->layout->title = $result->name;

		$results = \View::make('common/list');
		$results->items = $result->results()->get();

		$view = \View::make('common.tabs');
		$view->tabs = array(
				'Overview' => 'Charts here',
				'Results and Resultions' => $results,
				'People' => 'Users'
			);

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
			$result = new Result;
			$result->quarter  = PWR::getClean('quarter');
			$result->year  = PWR::getClean('year');
			$result->estimated  = PWR::getClean('estimated');
			$result->actual  = PWR::getClean('actual');
			$result->project_id = PWR::getClean('project_id');
			$result->save();

			// redirect
			\Flash::push('success', 'Successfully created result!');

			return $this->getRedirect();
		}
	}

	private function validate($update = false) {
		$rules = array(
			'quarter'  => 'required',
			'year'  => 'required',
			'estimated'  => 'required',
			'actual'  => 'required',
			'project_id'  => 'required'
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
		$form = \View::make('result.form');
		$form->result = Result::find($id);
		$form->action = array('action' => array('Powerhouse\Core\ResultController@update', $form->result->id),'class'=>'form-signup');
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
			$result = Result::find($id);
			$result->quarter  = PWR::getClean('quarter');
			$result->year  = PWR::getClean('year');
			$result->estimated  = PWR::getClean('estimated');
			$result->actual  = PWR::getClean('actual');
			$result->project_id = PWR::getClean('project_id');
			$result->save();

			// redirect
			\Flash::push('success', 'Successfully updated result!');
			return $this->getRedirect();
		}
	}

}
