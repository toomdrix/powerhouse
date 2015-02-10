<?php
namespace Powerhouse\Core;

class DoorstepController extends BaseController {

	protected $layout = 'template';

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$this->layout->title = "Login";
		$this->layout->content = \View::make('doorstep.login');
	}

	public function postLogin()
	{
		if (\Auth::attempt(array('email'=>PWR::getClean('email'), 'password'=>PWR::getClean('password')))) {
			\Flash::push('success', 'You are now logged in!');
			return \Redirect::to('dashboard');
		} else {
			\Flash::push('warning', 'Your username/password combination was incorrect');
			return \Redirect::to('doorstep')
			->withInput();
		}
	}

}
