<?php

namespace Totaa\TotaaTeam\Database\Seeders;

use Illuminate\Database\Seeder;
use Totaa\TotaaTeam\Models\TeamType;
use Totaa\TotaaTeam\Models\NhomKD;
use Totaa\TotaaTeam\Models\KenhKD;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TeamType::updateOrCreate(
            ['id' => 1],
            ['name' => "Sản xuất", 'active' => true]
        );
        TeamType::updateOrCreate(
            ['id' => 2],
            ['name' => "Văn phòng", 'active' => true]
        );
        TeamType::updateOrCreate(
            ['id' => 3],
            ['name' => "Kinh doanh", 'active' => true]
        );
        TeamType::updateOrCreate(
            ['id' => 4],
            ['name' => "MKT", 'active' => true]
        );
        TeamType::updateOrCreate(
            ['id' => 9],
            ['name' => "TTS", 'active' => true]
        );

        KenhKD::updateOrCreate(
            ['id' => 1],
            ['name' => "ETC", 'team_type_id' => '3', 'active' => true]
        );
        KenhKD::updateOrCreate(
            ['id' => 2],
            ['name' => "OTC", 'team_type_id' => '3', 'active' => true]
        );
        KenhKD::updateOrCreate(
            ['id' => 3],
            ['name' => "PS", 'team_type_id' => '3', 'active' => true]
        );
        KenhKD::updateOrCreate(
            ['id' => 4],
            ['name' => "GP", 'team_type_id' => '3', 'active' => true]
        );

        NhomKD::updateOrCreate(
            ['id' => 1],
            [
                'name' => "Mắt",
                'kenh_kd_id' => 1,
                'order' => 1,
                'active' => true,
            ]
        );

        NhomKD::updateOrCreate(
            ['id' => 2],
            [
                'name' => "Hô hấp",
                'kenh_kd_id' => 1,
                'order' => 2,
                'active' => true,
            ]
        );

        NhomKD::updateOrCreate(
            ['id' => 3],
            [
                'name' => "DT Plus",
                'kenh_kd_id' => 1,
                'order' => 3,
                'active' => true,
            ]
        );

        NhomKD::updateOrCreate(
            ['id' => 4],
            [
                'name' => "Thần kinh",
                'kenh_kd_id' => 1,
                'order' => 4,
                'active' => true,
            ]
        );

        NhomKD::updateOrCreate(
            ['id' => 5],
            [
                'name' => "Cơ xương khớp",
                'kenh_kd_id' => 1,
                'order' => 5,
                'active' => true,
            ]
        );

        NhomKD::updateOrCreate(
            ['id' => 6],
            [
                'name' => "Hỗn hợp",
                'kenh_kd_id' => 1,
                'order' => 99,
                'active' => true,
            ]
        );

        NhomKD::updateOrCreate(
            ['id' => 7],
            [
                'name' => "Hỗn hợp",
                'kenh_kd_id' => 2,
                'order' => 99,
                'active' => true,
            ]
        );

        NhomKD::updateOrCreate(
            ['id' => 8],
            [
                'name' => "Gây mê hồi sức",
                'kenh_kd_id' => 3,
                'order' => 1,
                'active' => true,
            ]
        );

        NhomKD::updateOrCreate(
            ['id' => 9],
            [
                'name' => "Sản",
                'kenh_kd_id' => 3,
                'order' => 2,
                'active' => true,
            ]
        );

        NhomKD::updateOrCreate(
            ['id' => 10],
            [
                'name' => "Hỗn hợp",
                'kenh_kd_id' => 3,
                'order' => 99,
                'active' => true,
            ]
        );

        NhomKD::updateOrCreate(
            ['id' => 11],
            [
                'name' => "Hỗn hợp",
                'kenh_kd_id' => 4,
                'order' => 99,
                'active' => true,
            ]
        );

    }
}
