<?php

namespace Totaa\TotaaTeam\Tests;

use Orchestra\Testbench\TestCase;
use Totaa\TotaaTeam\TotaaTeamServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [TotaaTeamServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
