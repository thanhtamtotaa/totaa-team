<?php

namespace Totaa\TotaaTeam\Http\Livewire;

use Livewire\Component;
use Auth;
use Totaa\TotaaTeam\Models\Team;
use Totaa\TotaaTeam\Models\TeamType;
use Totaa\TotaaTeam\Models\KenhKD;
use Totaa\TotaaTeam\Models\NhomKD;
use Totaa\TotaaBfo\Models\BfoInfo;

class TeamLivewire extends Component
{
    /**
     * Các biến sử dụng trong Component
     *
     * @var mixed
     */
    public $team_id, $team, $name, $team_type_id, $main_team_id, $kenh_kd_id, $nhom_kd_id, $order, $active, $created_by, $quanlys, $members;
    public $bfo_info, $modal_title, $toastr_message, $team_type_arrays, $bfo_info_arrays, $kenh_kd_arrays, $nhom_kd_arrays, $team_arrays;

    /**
     * Cho phép cập nhật updateMode
     *
     * @var bool
     */
    public $updateMode = false;
    public $editStatus = false;

    /**
     * Các biển sự kiện
     *
     * @var array
     */
    protected $listeners = ['add_team', 'edit_team', 'set_team_member', ];

    /**
     * Validation rules
     *
     * @var array
     */
    protected function rules() {
        return [
            'team_id' => 'nullable|exists:teams,id',
            'name' => 'required',
            'team_type_id' => 'required|exists:team_types,id',
            'main_team_id' => 'nullable|exists:teams,id',
            'kenh_kd_id' => 'nullable|exists:kenh_kinhdoanhs,id',
            'nhom_kd_id' => 'nullable|exists:nhom_kinhdoanhs,id',
            'order' => 'nullable|numeric',
            'active' => 'nullable|boolean',
            'created_by' => 'required|exists:bfo_infos,mnv',
            'quanlys' => 'nullable|array',
            'quanlys.*' => 'nullable|exists:bfo_infos,mnv',
            'members' => 'nullable|array',
            'members.*' => 'nullable|exists:bfo_infos,mnv',
        ];
    }

    /**
     * render view
     *
     * @return void
     */
    public function render()
    {
        return view('totaa-team::livewire.team-livewire');
    }

    /**
     * mount data
     *
     * @return void
     */
    public function mount()
    {
        $this->bfo_info = Auth::user()->bfo_info;
        $this->created_by = $this->bfo_info->mnv;
        $this->team_type_arrays = TeamType::where("active", true)->get();
        $this->team_arrays = Team::where("active", true)->where("id", "<>", $this->team_id)->get();
        $this->bfo_info_arrays = BfoInfo::where("active", true)->select("mnv", "full_name")->get()->toArray();

        if (!!$this->team_type_id) {
            $this->kenh_kd_arrays = optional(TeamType::find($this->team_type_id))->kenh_kds;
        } else {
            $this->kenh_kd_arrays = NULL;
        }

        if (!!$this->kenh_kd_id) {
            $this->nhom_kd_arrays = optional(KenhKD::find($this->kenh_kd_id))->nhom_kds;
        } else {
            $this->nhom_kd_arrays = NULL;
        }
    }

    /**
     * On updated action
     *
     * @param  mixed $propertyName
     * @return void
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedTeamTypeId()
    {
        $this->kenh_kd_arrays = optional(TeamType::find($this->team_type_id))->kenh_kds;
        $this->kenh_kd_id = NULL;
        $this->nhom_kd_id = NULL;
    }

    public function updatedKenhKdId()
    {
        $this->nhom_kd_arrays = optional(KenhKD::find($this->kenh_kd_id))->nhom_kds;
        $this->nhom_kd_id = NULL;
    }

    /**
     * cancel
     *
     * @return void
     */
    public function cancel()
    {
        $this->updateMode = false;
        $this->editStatus = false;
        $this->resetValidation();
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('hide_modal');
    }

    /**
     * add_team method
     *
     * @return void
     */
    public function add_team()
    {
        if ($this->bfo_info->cannot("add-team")) {
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Bạn không có quyền thực hiện hành động này"]);
            return null;
        }

        $this->modal_title = "Thêm nhóm mới";
        $this->toastr_message = "Thêm nhóm thành công";
        $this->active = true;
        $this->dispatchBrowserEvent('show_modal', "#add_edit_modal");
    }

    /**
     * save_team
     *
     * @return void
     */
    public function save_team()
    {
        if ($this->bfo_info->cannot("add-team")) {
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Bạn không có quyền thực hiện hành động này"]);
            return null;
        }

        $this->validate();

        try {
            $Team = Team::updateOrCreate([
                "id" => $this->team_id,
            ], [
                'name' => trim($this->name),
                "team_type_id" => $this->team_type_id,
                "main_team_id" => $this->main_team_id,
                "kenh_kd_id" => $this->kenh_kd_id,
                "nhom_kd_id" => $this->nhom_kd_id,
                "order" => $this->order,
                "active" => $this->active,
                "created_by" => $this->created_by
            ]);

            $Team->team_leaders()->sync($this->quanlys);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => implode(" - ", $e->errorInfo)]);
            return null;
        }

        //Đầy thông tin về trình duyệt
        $this->dispatchBrowserEvent('dt_draw');
        $this->dispatchBrowserEvent('toastr', ['type' => 'success', 'title' => "Thành công", 'message' => $this->toastr_message]);
        $this->cancel();
    }

    /**
     * edit_team method
     *
     * @return void
     */
    public function edit_team($id)
    {
        if ($this->bfo_info->cannot("edit-team")) {
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Bạn không có quyền thực hiện hành động này"]);
            return null;
        }

        $this->modal_title = "Chỉnh sửa nhóm";
        $this->toastr_message = "Chỉnh sửa nhóm thành công";
        $this->editStatus = true;
        $this->updateMode = true;

        $this->team_id = $id;
        $this->team = Team::find($this->team_id);
        $this->name = $this->team->name;
        $this->team_type_id = $this->team->team_type_id;
        $this->main_team_id = $this->team->main_team_id;
        $this->kenh_kd_id = $this->team->kenh_kd_id;
        $this->nhom_kd_id = $this->team->nhom_kd_id;
        $this->order = $this->team->order;
        $this->active = $this->team->active;
        $this->quanlys = $this->team->team_leaders->pluck("mnv");

        $this->kenh_kd_arrays = optional(TeamType::find($this->team_type_id))->kenh_kds;
        $this->nhom_kd_arrays = optional(KenhKD::find($this->kenh_kd_id))->nhom_kds;

        $this->dispatchBrowserEvent('show_modal', "#add_edit_modal");
    }

    /**
     * set_team_member
     *
     * @param  mixed $id
     * @return void
     */
    public function set_team_member($id)
    {
        if ($this->bfo_info->cannot("edit-team")) {
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Bạn không có quyền thực hiện hành động này"]);
            return null;
        }

        $this->modal_title = "Cập nhật thành viên";
        $this->toastr_message = "Cập nhật thành viên thành công";
        $this->updateMode = true;

        $this->team_id = $id;
        $this->team = Team::find($this->team_id);
        $this->name = $this->team->name;
        $this->members = $this->team->team_members->pluck("mnv");

        $this->dispatchBrowserEvent('show_modal', "#set_team_member_modal");
    }

    /**
     * save_team_member
     *
     * @param  mixed $id
     * @return void
     */
    public function save_team_member()
    {
        if ($this->bfo_info->cannot("edit-team")) {
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Bạn không có quyền thực hiện hành động này"]);
            return null;
        }

        $this->validate();

        try {
            $this->team->team_members()->sync($this->members);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => implode(" - ", $e->errorInfo)]);
            return null;
        }

        //Đầy thông tin về trình duyệt
        $this->dispatchBrowserEvent('dt_draw');
        $this->dispatchBrowserEvent('toastr', ['type' => 'success', 'title' => "Thành công", 'message' => $this->toastr_message]);
        $this->cancel();
    }
}
