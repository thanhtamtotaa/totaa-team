<?php

namespace Totaa\TotaaTeam\DataTables;

use Totaa\TotaaTeam\Models\Team;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Auth;

class AdminTeamDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($query) {
                $Action_Icon="<div class='action-div icon-4 px-0 mx-1 d-flex justify-content-around text-center'>";

                if (Auth::user()->bfo_info->can("edit-team")) {
                    $Action_Icon.="<div class='col action-icon-w-50 action-icon' totaa-edit-team='$query->id'><i class='text-indigo fas fa-edit'></i></div>";
                }

                if (Auth::user()->bfo_info->can("edit-team")) {
                    $Action_Icon.="<div class='col action-icon-w-50 action-icon' totaa-set-team-member='$query->id'><i class='text-danger fas fa-trash-alt'></i></div>";
                }

                $Action_Icon.="</div>";

                return $Action_Icon;
            })
            ->editColumn('active', function ($query) {
                if (!!$query->active) {
                    return "Đã kích hoạt";
                } else {
                    return "Đã vô hiệu hóa";
                }
            })
            ->editColumn('team_leaders', function ($query) {
                return implode(", ", $query->team_leaders->pluck("full_name")->toArray());
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Totaa\TotaaTeam\Models\Team $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Team $model)
    {
        $query = $model->newQuery();

        if (!request()->has('order')) {
            $query->orderBy('order', 'desc')->orderBy('id', 'asc');
        };

        return $query->with(["main_team:*", "team_leaders:*", "nhom_kd:*", "kenh_kd:*", "team_type:*"]);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('team-table')
                    ->columns($this->getColumns())
                    ->dom("<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'row'<'col-sm-12 table-responsive't>><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>")
                    ->parameters([
                        "autoWidth" => false,
                        "lengthMenu" => [
                            [10, 25, 50, -1],
                            [10, 25, 50, "Tất cả"]
                        ],
                        "order" => [],
                        'initComplete' => 'function(settings, json) {
                            var api = this.api();
                            window.addEventListener("dt_draw", function(e) {
                                api.draw(false);
                                e.preventDefault();
                            })
                            api.buttons()
                                .container()
                                .appendTo($("#datatable-button"));
                        }',
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center')
                    ->title("")
                    ->footer(""),
            Column::make('name')
                    ->title("Tên Nhóm")
                    ->width(150)
                    ->searchable(true)
                    ->orderable(true)
                    ->footer("Tên Nhóm"),
            Column::make('team_type.name')
                    ->title("Phân loại")
                    ->width(25)
                    ->searchable(false)
                    ->orderable(false)
                    ->render("function() {
                          if (!!data) {
                              return data;
                          } else {
                              return null;
                          }
                      }")
                    ->footer("Phân loại"),
            Column::make('kenh_kd.name')
                    ->title("Kênh")
                    ->width(25)
                    ->searchable(false)
                    ->orderable(false)
                    ->render("function() {
                          if (!!data) {
                              return data;
                          } else {
                              return null;
                          }
                      }")
                    ->footer("Kênh"),
            Column::make('team_leaders')
                    ->title("Quản lý")
                    ->width(25)
                    ->searchable(false)
                    ->orderable(false)
                    ->render("function() {
                          if (!!data) {
                              return data;
                          } else {
                              return null;
                          }
                      }")
                    ->footer("Quản lý"),
            Column::make('main_team.name')
                    ->title("Trực thuộc")
                    ->width(25)
                    ->searchable(false)
                    ->orderable(false)
                    ->render("function() {
                          if (!!data) {
                              return data;
                          } else {
                              return null;
                          }
                      }")
                    ->footer("Trực thuộc"),
            Column::make('nhom_kd.name')
                    ->title("Nhóm SP")
                    ->width(25)
                    ->searchable(false)
                    ->orderable(false)
                    ->render("function() {
                          if (!!data) {
                              return data;
                          } else {
                              return null;
                          }
                      }")
                    ->footer("Nhóm SP"),
            Column::make('active')
                    ->title("Trạng thái")
                    ->searchable(false)
                    ->orderable(false)
                    ->render("function() {
                          if (!!data) {
                              return data;
                          } else {
                              return null;
                          }
                      }")
                    ->footer("Trạng thái"),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Team_' . date('YmdHis');
    }
}
