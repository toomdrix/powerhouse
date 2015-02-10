<?php
namespace Powerhouse\Core;

class BaseController extends \Controller {

	protected $layout = 'template';

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = \View::make($this->layout);
		}
	}

	protected function getRedirect() {
		if ($url = PWR::getClean('ph_redirect')) {
			return \Redirect::to($url);
		} else {
			return \Redirect::to(PWR::getModuleName());
		}
	}

}
