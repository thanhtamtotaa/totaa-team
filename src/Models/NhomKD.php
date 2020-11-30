<?php

namespace Totaa\TotaaTeam\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use Totaa\TotaaTeam\Models\TeamType;
use Totaa\TotaaTeam\Models\Team;
use Totaa\TotaaTeam\Models\KenhKD;

class NhomKD extends Model
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
    protected $table = 'nhom_kinhdoanhs';

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
     * Mỗi nhóm kinh doanh có thể thuộc một kênh kinh doanh
     *
     * @return void
     */
    public function kenh_kd()
    {
        return $this->belongsTo(KenhKD::class, 'kenh_kd_id', 'id');
    }
}
