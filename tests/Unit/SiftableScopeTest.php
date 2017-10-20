<?php

namespace Tests\Unit;

use Mockery as m;
use Tests\TestCase;

/**
 * @group unit.database
 */
class SiftableScopeTest extends TestCase
{
    /** @test */
    public function itAppliesQueryScope()
    {
        $model = $this->getMockForTrait('Samrap\Sift\SiftableScope');
        $query = m::mock('Illuminate\Database\Eloquent\Builder');
        $filters = m::mock('Samrap\Sift\QueryFilters');
        $filters
            ->shouldReceive('apply')
            ->atLeast()
            ->once()
            ->with($query)
            ->andReturn($query);

        $this->assertSame($query, $model->scopeSift($query, $filters));
    }
}
