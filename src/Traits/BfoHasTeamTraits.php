<?php

namespace Totaa\TotaaTeam\Traits;

use Totaa\TotaaTeam\Models\Team;

trait BfoHasTeamTraits
{
    /**
     * Một người có thể là leader của nhiều team
     *
     * @return void
     */
    public function leader_of_teams()
    {
        return $this->belongsToMany(Team::class, 'team_leaders_table', 'leader_mnv', 'team_id');
    }

    /**
     * Một người có thể là thành viên của nhiều team
     *
     * @return void
     */
    public function member_of_teams()
    {
        return $this->belongsToMany(Team::class, 'team_leaders_table', 'member_mnv', 'team_id');
    }

    public function is_leader_of_team()
    {
        dd($this);
    }

}
