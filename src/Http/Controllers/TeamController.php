<?php

namespace Totaa\TotaaTeam\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Totaa\TotaaTeam\DataTables\AdminTeamDataTable;

class TeamController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index(AdminTeamDataTable $dataTable)
    {
        if (Auth::user()->bfo_info->hasAnyPermission(["view-team"])) {
            return $dataTable->render('totaa-team::team', ['title' => 'Quản lý Nhóm']);
        } else {
            return view('errors.dynamic', [
                'error_code' => '403',
                'error_description' => 'Không có quyền truy cập',
                'title' => 'Quản lý Nhóm',
            ]);
        }
    }
}
