<?php namespace Powerhouse\Core;

use Eloquent;
use DB;

class Configuration extends Eloquent {

	public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'config';
	protected $primaryKey = 'key';

}
