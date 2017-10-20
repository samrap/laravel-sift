<?php

namespace Gigasavvy\Locator\Database\Filters;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

class QueryFilters
{
    /**
     * The collection of filters to use.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $filters;

    /**
     * Create a new instance.
     *
     * @param  \Illuminate\Support\Collection|array  $filters
     */
    public function __construct($filters)
    {
        $this->filters = $this->filtersCollection($filters);
    }

    /**
     * Ensure that the given filters are a Collection.
     *
     * @param  \Illuminate\Support\Collection|array  $filters
     * @return  \Illuminate\Support\Collection
     */
    private function filtersCollection($filters)
    {
        return ($filters instanceof Collection)
            ? $filters
            : collect($filters);
    }

    /**
     * Apply filters to the given query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Builder $query)
    {
        $this->filters->each(function ($value, $filter) use ($query) {
            if (method_exists($this, $filter)) {
                $this->{$filter}($query, $value);
            }
        });

        return $query;
    }

    /**
     * Limit the query results to the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int  $max
     * @return void
     */
    protected function limit(Builder $query, $max)
    {
        $query->take((int) $max);
    }

    /**
     * Set the sort order and direction on the query.
     *
     * The direction will default to ascending order, but can be set as
     * descending by prepending a '-' (without quotes) to the order.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $order
     * @return void
     */
    protected function order(Builder $query, $order)
    {
        $direction = (strpos($order, '-') === 0) ? 'desc' : 'asc';

        $query->orderBy(trim($order, '-+'),  $direction);
    }

    /**
     * Select only the given fields from the database.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array|string  $fields
     * @return void
     */
    protected function fields(Builder $query, $fields)
    {
        if (! is_array($fields)) {
            $fields = explode(',', $fields);
        }

        $query->select($fields);
    }
}
