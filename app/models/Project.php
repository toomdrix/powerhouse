<?php namespace Powerhouse\Core;

use Eloquent;
use DB;

class Project extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'project';

	public function getPrimaryInfo($include_actions = true) {
		$info = array(
				'Name'=> array('text'=>$this->name, 'link'=>'/project/'.$this->id),
				'Company'=> array('text'=>$this->company->name, 'link'=>'/company/'.$this->id),
				'Actions'=> array('text'=>\View::make('project.list.actions')->with('id',$this->id))
			);

		if (!$include_actions) {
			unset($info['Actions']);
		}

		return $info;
	}

	public function company()
    {
        return $this->belongsTo('Powerhouse\Core\Company');
    }

    public function results()
    {
        return $this->hasMany('Powerhouse\Core\Result');
    }

    public function getOverview() {
    	
    	$real_estimated = $this->getRealEstimatedLineChart();

    	$table = \View::make('common/list_minimal');
		$table->items =  $this->results()->get();

		$overview = \View::make('project/overview');
		$overview->charts = array(
			$real_estimated,
			$table
		);

		return $overview;
    }

    public function getRealEstimatedLineChart($results = false) {

    	if (!$results) {
	    	$results = $this->results()->orderby('year')->orderby('quarter')->get();
    	}

		$estimated = array();
		$actual = array();
		$labels = array();

		foreach ($results as $result) {
			$labels[] = 'Q'.$result->quarter.' '.$result->year;
			$actual[] = $result->getOriginal('actual');
			$estimated[] = $result->getOriginal('estimated');
		}

		$line_chart = Chart::make('line');
		$line_chart->setLabels($labels);
		$line_chart->addDataSet('Estimated', $estimated);
		$line_chart->addDataSet('Actual', $actual);

		$real_estimated = \View::make('chart/line');
		$real_estimated->chart = $line_chart;

		return $real_estimated;
    }

    public function getAllResults($clients) {
    	$results = Result::select(
					'quarter',
					'year',
					\DB::raw('sum(estimated) as estimated'),
					\DB::raw('sum(actual) as actual'))
					->orderby('year')
					->orderby('quarter')
					->groupBy(\DB::raw('CONCAT(quarter,year)'));

		if (isset($clients) && !empty($clients)) {
			$results = $results->join('project', 'project.id', '=', 'result.project_id')
						->join('company', 'project.company_id', '=', 'company.id')->whereIn('company.id',$clients);
		}
					
		return $results->get();
    }

}
