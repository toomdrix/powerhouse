<?php namespace Powerhouse\Core;

use Illuminate\Database\Eloquent\Model as CoreModel;

abstract class Model extends CoreModel {

	/**
	 * Create a new Eloquent query builder for the model.
	 *
	 * @param  \Illuminate\Database\Query\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder|static
	 */
	public function newEloquentBuilder($query)
	{
		return new Builder($query);
	}

	public function newCollection(array $models = array()) {

		return new Collection($models);
	}

	/**
	 * Define a has-many-through relationship.
	 *
	 * @param  string  $related
	 * @param  string  $through
	 * @param  string|null  $firstKey
	 * @param  string|null  $secondKey
	 * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
	 */
	public function hasManyThrough($related, $through, $firstKey = null, $secondKey = null)
	{
		$through = new $through;

		$firstKey = $firstKey ?: $this->getForeignKey();

		$secondKey = $secondKey ?: $through->getForeignKey();

		return new HasManyThrough(with(new $related)->newQuery(), $this, $through, $firstKey, $secondKey);
	}

}
