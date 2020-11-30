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

        KenhKD::updateOrCreate(
            ['id' => 9],
            ['name' => "MKT", 'team_type_id' => '2', 'active' => true]
        );

        NhomKD::updateOrCreate(
            ['id' => 1],
            [
                'name' => "Mắt",
                'team_type_id' => '3',
                'order' => 1,
                'active' => true,
            ]
        );

        NhomKD::updateOrCreate(
            ['id' => 2],
            [
                'name' => "Hô hấp",
                'team_type_id' => '3',
                'order' => 2,
                'active' => true,
            ]
        );

        NhomKD::updateOrCreate(
            ['id' => 3],
            [
                'name' => "DT Plus",
                'team_type_id' => '3',
                'order' => 3,
                'active' => true,
            ]
        );

        NhomKD::updateOrCreate(
            ['id' => 4],
            [
                'name' => "Thần kinh",
                'team_type_id' => '3',
                'order' => 4,
                'active' => true,
            ]
        );

        NhomKD::updateOrCreate(
            ['id' => 5],
            [
                'name' => "Cơ xương khớp",
                'team_type_id' => '3',
                'order' => 5,
                'active' => true,
            ]
        );

        NhomKD::updateOrCreate(
            ['id' => 6],
            [
                'name' => "Hỗn hợp",
                'team_type_id' => '3',
                'order' => 99,
                'active' => true,
            ]
        );

        NhomKD::updateOrCreate(
            ['id' => 7],
            [
                'name' => "Hỗn hợp",
                'team_type_id' => '3',
                'kenh_kd_id' => 2,
                'order' => 99,
                'active' => true,
            ]
        );

        NhomKD::updateOrCreate(
            ['id' => 8],
            [
                'name' => "Gây mê hồi sức",
                'team_type_id' => '3',
                'kenh_kd_id' => 3,
                'order' => 1,
                'active' => true,
            ]
        );

        NhomKD::updateOrCreate(
            ['id' => 9],
            [
                'name' => "Sản",
                'team_type_id' => '3',
                'kenh_kd_id' => 3,
                'order' => 2,
                'active' => true,
            ]
        );

        NhomKD::updateOrCreate(
            ['id' => 10],
            [
                'name' => "Hỗn hợp",
                'team_type_id' => '3',
                'kenh_kd_id' => 3,
                'order' => 99,
                'active' => true,
            ]
        );

        NhomKD::updateOrCreate(
            ['id' => 11],
            [
                'name' => "Hỗn hợp",
                'team_type_id' => '3',
                'kenh_kd_id' => 4,
                'order' => 99,
                'active' => true,
            ]
        );

    }
}
