<?php

namespace Totaa\TotaaTeam\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use Totaa\TotaaTeam\Models\Team;
use Totaa\TotaaTeam\Models\NhomKD;

class TeamType extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;

    // Disable Laravel's mass assignment protection
    protected $guarded = ['id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'team_types';

    /**
     * Mỗi loại nhóm có thể có nhiều nhóm
     *
     * @return void
     */
    public function teams()
    {
        return $this->hasMany(Team::class, 'team_type_id', 'id');
    }

    /**
     * Mỗi kênh kinh doanh có nhiều nhóm kinh doanh
     * nhom_kds
     *
     * @return void
     */
    public function nhom_kds()
    {
        return $this->hasMany(NhomKD::class, 'team_type_id', 'id');
    }
}
