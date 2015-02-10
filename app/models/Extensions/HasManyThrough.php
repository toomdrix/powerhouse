<?php namespace Powerhouse\Core;

use Illuminate\Database\Eloquent\Relations\HasManyThrough as EloHasManyThrough;

class HasManyThrough extends EloHasManyThrough {

	/**
	 * Execute the query as a "select" statement.
	 *
	 * @param  array  $columns
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function get($columns = array('*'))
	{
		// First we'll add the proper select columns onto the query so it is run with
		// the proper columns. Then, we will get the results and hydrate out pivot
		// models with the result of those columns as a separate model relation.
		$select = $this->getSelectColumns($columns);

		$models = $this->query->addSelect($select)->getModels();

		// If we actually found models we will also eager load any relationships that
		// have been specified as needing to be eager loaded. This will solve the
		// n + 1 query problem for the developer and also increase performance.
		if (count($models) > 0)
		{
			$models = $this->query->eagerLoadRelations($models);
		}


		$collection = $this->related->newCollection($models);
		$collection->type = $this->related->getTable();

		return $collection;
	}

}
