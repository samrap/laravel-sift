<?php

namespace Samrap\Sift;

trait SiftableScope
{
    /**
     * Apply the filters to the given query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \Gigasavvy\Locator\Database\Filters\QueryFilters  $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSift($query, QueryFilters $filters)
    {
        return $filters->apply($query);
    }
}
