<?php

namespace Totaa\TotaaTeam\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use Totaa\TotaaTeam\Models\TeamType;
use Totaa\TotaaTeam\Models\Team;

class KenhKD extends Model
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
    protected $table = 'kenh_kinhdoanhs';

    /**
     * Mỗi nhóm kinh doanh sẽ có nhiều nhóm
     *
     * @return void
     */
    public function teams()
    {
        return $this->hasMany(Team::class, 'nhom_kd_id', 'id');
    }

    /**
     * Mỗi nhóm kinh doanh có thể thuộc một phận loại nhóm nào đó
     *
     * @return void
     */
    public function team_type()
    {
        return $this->belongsTo(TeamType::class, 'team_type_id', 'id');
    }

    /**
     * Mỗi kênh có nhiều nhóm kinh doanh
     * nhom_kds
     *
     * @return void
     */
    public function nhom_kds()
    {
        return $this->hasMany(NhomKD::class, 'kenh_kd_id', 'id');
    }
}
