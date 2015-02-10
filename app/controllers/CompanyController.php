<?php namespace Powerhouse\Core;

class CompanyController extends BaseController {

	public function index()
	{

		$list = \View::make('common/list');
		$list->items = Company::paginate(Configuration::find('num_list_items')->value);

		$this->layout->content = $list;

		//$this->layout->sidebar = View::make('block.sidebar.project.categories');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$form = \View::make('company.form');
		$form->action = array('action' => 'Powerhouse\Core\CompanyController@store', 'class'=>'form-signup');
		return $form;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$company = Company::find($id);
		$this->layout->title = $company->name;

		$users = \View::make('common/list');
		$users->items = $company->users()->paginate();

		$projects = \View::make('common/list');
		$projects->items = $company->projects()->paginate();

		$view = \View::make('common.tabs');
		$view->tabs = array(
				'People' => $users,
				'Projects' => $projects
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
			return \Redirect::to('company')
			->withErrors($this->validator)
			->withInput(\Input::all());
		} else {
			// store
			$company = new Company;
			$company->name  = PWR::getClean('name');
			$company->phone = PWR::getClean('phone');
			$company->email = PWR::getClean('email');
			$company->save();

			// redirect
			\Flash::push('success', 'Successfully created company!');

			return \Redirect::to('company');
		}
	}

	private function validate($update = false) {
		$rules = array(
			'name'  => 'required',
			'phone'   => 'required',
			'email'      => 'required|email'.(!$update ? '|unique:company':'' )
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
		$form = \View::make('company.form');
		$form->company = Company::find($id);
		$form->action = array('action' => array('Powerhouse\Core\CompanyController@update', $form->company->id),'class'=>'form-signup');
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
			return \Redirect::to('company')
			->withErrors($this->validator)
			->withInput(\Input::all());
		} else {
			// store
			$company = Company::find($id);
			$company->name  = PWR::getClean('name');
			$company->phone = PWR::getClean('phone');
			$company->email = PWR::getClean('email');
			$company->save();

			// redirect
			\Flash::push('success', 'Successfully updated company!');
			return \Redirect::to('company');
		}
	}

}
