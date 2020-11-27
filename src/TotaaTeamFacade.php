<?php

namespace Totaa\TotaaTeam;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Totaa\TotaaTeam\Skeleton\SkeletonClass
 */
class TotaaTeamFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'totaa-team';
    }
}
