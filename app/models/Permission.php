<?php namespace Powerhouse\Core;

use Eloquent;
use DB;

class Permission extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'permission';

	public function getPrimaryInfo() {
		return array(
				'Name'=> array('text'=>$this->name, 'link'=>'/permission/'.$this->id),
				'Actions'=> array('text'=>\View::make('permission.list.actions')->with('id',$this->id))
			);
	}

	public function usergroup()
    {
        return $this->belongsTo('Powerhouse\Core\Usergroup');
    }

}
