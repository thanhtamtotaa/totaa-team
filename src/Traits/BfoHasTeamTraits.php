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

    /**
     * Kiểm tra xem có phải là quản lý của một team nào đó
     *
     * @param  mixed $team
     * @return void
     */
    public function is_leader_of_team(Team $team = NULL)
    {
        return !!optional(optional($team)->team_leaders)->contains($this);
    }

    /**
     * Kiểm tra xem có phải là thành viên của một team nào đó
     *
     * @param  mixed $team
     * @return void
     */
    public function is_member_of_team(Team $team = NULL)
    {
        return !!optional(optional($team)->team_members)->contains($this);
    }

}
