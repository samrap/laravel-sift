<?php

namespace Tests;

use Mockery;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    /**
     * Set up the test class.
     *
     * @return void
     */
    public function setUp()
    {
        //
    }

    /**
     * Tear down the test class.
     *
     * @return void
     */
    public function tearDown()
    {
        Mockery::close();
    }
}
