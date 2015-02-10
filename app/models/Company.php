<?php namespace Powerhouse\Core;

use Eloquent;
use DB;

class Company extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'company';

	public function getPrimaryInfo() {
		return array(
				'Name'=> array('text'=>$this->name, 'link'=>'/company/'.$this->id),
				'Telephone'=> array('text'=>$this->phone, 'link'=>'/company/'.$this->id),
				'Email'=> array('text'=> $this->email, 'link'=>'/company/'.$this->id),
				'Actions'=> array('text'=>\View::make('company.list.actions')->with('id',$this->id))
			);
	}

	public function users()
    {
        return $this->hasMany('User');
    }

    public function projects()
    {
        return $this->hasMany('Powerhouse\Core\Project');
    }

}
