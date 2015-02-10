<?php namespace Powerhouse\Core;

use Eloquent;
use DB;

class Usergroup extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'usergroup';

	public function getPrimaryInfo() {
		return array(
				'Name'=> array('text'=>$this->name, 'link'=>'/usergroup/'.$this->id),
				'Actions'=> array('text'=>\View::make('company.list.actions')->with('id',$this->id))
			);
	}

	public function users()
    {
        return $this->hasMany('User');
    }

    public function permissions()
    {
        return $this->hasMany('Powerhouse\Core\Permission');
    }

    // determine if user can view resource.
    // guilty until proven innocent
    public function denied($path) {
    	$denied = true;
    	$parts = explode(".", $path);
    	$module = $parts[0];
    	$action = $parts[1];

    	if ($group_action = $this->isAllowed($this->id, $module, $action)) {
			if ($group_module = $this->isAllowed($this->id, $module)) {
				$denied = false;
			}
		}

    	return $denied;
    }

    private function isAllowed($id, $module, $action = null) {

    	$query = $this->permissions()->where('module', $module)
    									->where('usergroup_id', $id);

    	if ($action) {
    		$query->where('action', $action);
    	}

    	return $query->first() ? false:true;
    }

}
