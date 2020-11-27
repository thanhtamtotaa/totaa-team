<?php

namespace Totaa\TotaaTeam\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use Totaa\TotaaTeam\Models\TeamType;
use Totaa\TotaaTeam\Models\NhomKD;
use Totaa\TotaaBfo\Models\BfoInfo;

class Team extends Model
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
    protected $table = 'teams';

    /**
     * Mỗi nhóm có thể thuộc một phận loại nhóm nào đó
     *
     * @return void
     */
    public function team_type()
    {
        return $this->belongsTo(TeamType::class, 'team_type_id', 'id');
    }

    /**
     * Nếu là nhóm kinh doanh, có thể thuộc một nhóm sp cụ thể
     *
     * @return void
     */
    public function nhom_kd()
    {
        return $this->belongsTo(NhomKD::class, 'nhom_kd_id', 'id');
    }

    /**
     * Một team có thể có nhiều người quản lý
     *
     * @return void
     */
    public function team_leaders()
    {
        return $this->belongsToMany(BfoInfo::class, 'team_leader_table', 'team_id', 'leader_mnv');
    }

    /**
     * Môt team có nhiều thanh viên
     *
     * @return void
     */
    public function team_members()
    {
        return $this->belongsToMany(BfoInfo::class, 'team_member_table', 'team_id', 'member_mnv');
    }
}
