<?php namespace Powerhouse\Core;

use Eloquent;
use DB;

class Result extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'result';

	public function getPrimaryInfo($include_actions = true) {
		$info = array(
				'Period'=> array('text'=>$this->year.' Q'.$this->quarter, 'link'=>'#'),
				'Estimated'=> array('text'=>$this->estimated, 'link'=>'#'),
				'Actual'=> array('text'=>$this->actual, 'link'=>'#'),
				'Difference'=> array('text'=>$this->getDifference(), 'link'=>'#'),
				'Actions'=> array('text'=>\View::make('result.list.actions')->with('id',$this->id))
			);

		if (!$include_actions) {
			unset($info['Actions']);
		}

		return $info;
	}

	private function getDifference() {
		return number_format($this->getOriginal('actual') - $this->getOriginal('estimated'));
	}

	public function getEstimatedAttribute($value) {
		return '&pound;'.number_format($value);
	}

	public function getActualAttribute($value) {
		return '&pound;'.number_format($value);
	}

	public function project()
    {
        return $this->belongsTo('Powerhouse\Core\Project');
    }

}
