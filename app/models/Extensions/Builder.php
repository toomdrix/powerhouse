<?php namespace Powerhouse\Core;

use Illuminate\Database\Eloquent\Builder as CoreBuilder;

class Builder extends CoreBuilder {

	/**
	 * Execute the query as a "select" statement.
	 *
	 * @param  array  $columns
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function get($columns = array('*'))
	{
		$models = $this->getModels($columns);

		// If we actually found models we will also eager load any relationships that
		// have been specified as needing to be eager loaded, which will solve the
		// n+1 query issue for the developers to avoid running a lot of queries.
		if (count($models) > 0)
		{
			$models = $this->eagerLoadRelations($models);
		}

		$collection = $this->model->newCollection($models);
		$collection->type = $this->model->getTable();

		return $collection;
	}
}
