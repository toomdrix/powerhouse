<?php namespace Powerhouse\Core;

class UsergroupController extends BaseController {

	public function index()
	{

		$list = \View::make('common/list');
		$list->items = Usergroup::paginate(Configuration::find('num_list_items')->value);

		$this->layout->content = $list;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$form = \View::make('usergroup.form');
		$form->action = array('action' => 'Powerhouse\Core\UsergroupController@store', 'class'=>'form-signup');
		return $form;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if (!$this->validate()) {
			return \Redirect::to('usergroup')
			->withErrors($this->validator)
			->withInput(\Input::except('password'));
		} else {
			// store
			$usergroup = new Usergroup;
			$usergroup->firstname  = PWR::getClean('firstname');
			$usergroup->lastname   = PWR::getClean('lastname');
			$usergroup->company_id = PWR::getClean('company_id');
			$usergroup->email      = PWR::getClean('email');
			$usergroup->password   = \Hash::make(PWR::getClean('password'));
			$usergroup->save();

			// redirect
			\Flash::push('success', 'Successfully created usergroup!');

			return \Redirect::to('usergroup');
		}
	}

	private function validate($update = false) {
		$rules = array(
			'firstname'  => 'required',
			'lastname'   => 'required',
			'email'      => 'required|email'.(!$update ? '|unique:usergroups':'' ),
			'password'   => 'required'
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
		$form = \View::make('usergroup.form');
		$form->usergroup = Usergroup::find($id);
		$form->action = array('action' => array('Powerhouse\Core\UsergroupController@update', $form->usergroup->id),'class'=>'form-signup');
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
			return \Redirect::to('usergroup')
			->withErrors($this->validator)
			->withInput(\Input::except('password'));
		} else {
			// store
			$usergroup = Usergroup::find($id);
			$usergroup->firstname  = PWR::getClean('firstname');
			$usergroup->lastname   = PWR::getClean('lastname');
			$usergroup->email      = PWR::getClean('email');
			$usergroup->company_id = PWR::getClean('company_id');
			$usergroup->password   = \Hash::make(PWR::getClean('password'));
			$usergroup->save();

			// redirect
			\Flash::push('success', 'Successfully updated usergroup!');
			return \Redirect::to('usergroup');
		}
	}

}
