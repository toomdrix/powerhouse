<?php namespace Powerhouse\Core;

class UserController extends BaseController {

	public function index()
	{

		$list = \View::make('common/list');
		$list->items = \User::paginate(Configuration::find('num_list_items')->value);

		$this->layout->content = $list;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$form = \View::make('user.form');
		$form->action = array('action' => 'Powerhouse\Core\UserController@store', 'class'=>'form-signup');
		return $form;
	}

	public function destroy($id)
	{
		$user = \User::find($id);
		$user->delete();
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
		$user = \User::find($id);
		$this->layout->title = $user->firstname . ' ' .$user->lastname;

		//$users = \View::make('common/list');
		//$users->items = $user->users()->paginate();

		$view = \View::make('common.tabs');
		$view->tabs = array(
				'Overview' => 'Overview'
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
			return \Redirect::to('user')
			->withErrors($this->validator)
			->withInput(\Input::except('password'));
		} else {
			// store
			$user = new \User;
			$user->firstname  = PWR::getClean('firstname');
			$user->lastname   = PWR::getClean('lastname');
			$user->company_id = PWR::getClean('company_id');
			$user->email      = PWR::getClean('email');
			$user->usergroup_id	= PWR::getClean('usergroup_id');
			$user->password   = \Hash::make(PWR::getClean('password'));
			$user->save();

			// redirect
			\Flash::push('success', 'Successfully created user!');

			\Event::fire('user.created', array($user));

			return \Redirect::to('user');
		}
	}

	private function validate($update = false) {
		$rules = array(
			'firstname'  => 'required',
			'lastname'   => 'required',
			'email'      => 'required|email'.(!$update ? '|unique:users':'' ),
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
		$form = \View::make('user.form');
		$form->user = \User::find($id);
		$form->action = array('action' => array('Powerhouse\Core\UserController@update', $form->user->id),'class'=>'form-signup');
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
			return \Redirect::to('user')
			->withErrors($this->validator)
			->withInput(\Input::except('password'));
		} else {
			// store
			$user = \User::find($id);
			$user->firstname  = PWR::getClean('firstname');
			$user->lastname   = PWR::getClean('lastname');
			$user->email      = PWR::getClean('email');
			$user->company_id = PWR::getClean('company_id');
			$user->usergroup_id	= PWR::getClean('usergroup_id');
			$user->password   = \Hash::make(PWR::getClean('password'));
			$user->save();

			// redirect
			\Flash::push('success', 'Successfully updated user!');
			return \Redirect::to('user');
		}
	}

}
