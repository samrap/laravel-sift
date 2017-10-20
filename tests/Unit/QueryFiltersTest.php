<?php

namespace Tests\Unit;

use Samrap\Sift\QueryFilters;
use Mockery as m;
use Tests\TestCase;

/**
 * @group unit.database
 */
class QueryFiltersTest extends TestCase
{
    /** @test */
    public function limitFilter()
    {
        $filters = new QueryFilters(['limit' => 2]);

        $query = m::mock('Illuminate\Database\Eloquent\Builder');
        $query
            ->shouldReceive('take')
            ->atLeast()
            ->once()
            ->with(2);

        $this->assertSame($query, $filters->apply($query));
    }

    /** @test */
    public function orderFilter()
    {
        $filters = new QueryFilters(['order' => 'foo']);

        $query = m::mock('Illuminate\Database\Eloquent\Builder');
        $query
            ->shouldReceive('orderBy')
            ->atLeast()
            ->once()
            ->with('foo', 'asc');

        $this->assertSame($query, $filters->apply($query));
    }

    /** @test */
    public function orderFilterDescending()
    {
        $filters = new QueryFilters(['order' => '-foo']);

        $query = m::mock('Illuminate\Database\Eloquent\Builder');
        $query
            ->shouldReceive('orderBy')
            ->atLeast()
            ->once()
            ->with('foo', 'desc');

        $this->assertSame($query, $filters->apply($query));
    }

    /** @test */
    public function fieldsFilter()
    {
        $fields = ['foo', 'bar', 'baz'];
        $filters = new QueryFilters(['fields' => $fields]);

        $query = m::mock('Illuminate\Database\Eloquent\Builder');
        $query
            ->shouldReceive('select')
            ->atLeast()
            ->once()
            ->with($fields);

        $this->assertSame($query, $filters->apply($query));
    }

    /** @test */
    public function fieldsFilterAsString()
    {
        $fields = 'foo,bar,baz';
        $filters = new QueryFilters(['fields' => $fields]);

        $query = m::mock('Illuminate\Database\Eloquent\Builder');
        $query
            ->shouldReceive('select')
            ->atLeast()
            ->once()
            ->with(explode(',', $fields));

        $this->assertSame($query, $filters->apply($query));
    }
}
