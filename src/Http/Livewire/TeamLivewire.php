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
    public $team_id, $name, $team_type_id, $main_team_id, $kenh_kd_id, $nhom_kd_id, $order, $active, $created_by, $quanlys;
    public $bfo_info, $modal_title, $team_type_arrays, $bfo_info_arrays, $kenh_kd_arrays, $nhom_kd_arrays;

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
    protected $listeners = ['add_team', 'edit_team', 'delete_team', ];

    /**
     * Validation rules
     *
     * @var array
     */
    protected function rules() {
        return [
            'name' => 'required|not_regex:/^[0-9]*$/|unique:teams,name,'.$this->team_id,

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
        $this->bfo_info_arrays = BfoInfo::where("active", true)->get();

        if (!!$this->team_type_id) {
            $this->kenh_kd_arrays = TeamType::find($this->team_type_id)->kenh_kds;
        } else {
            $this->kenh_kd_arrays = NULL;
        }

        if (!!$this->kenh_kd_id) {
            $this->nhom_kd_arrays = KenhKD::find($this->kenh_kd_id)->kenh_kd;
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

    /**
     * cancel
     *
     * @return void
     */
    public function cancel()
    {
        $this->updateMode = false;
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
        if (Auth::user()->bfo_info->cannot("add-team")) {
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Bạn không có quyền thực hiện hành động này"]);
            return null;
        }

        $this->modal_title = "Thêm nhóm mới";

        $this->dispatchBrowserEvent('show_modal', "#add_edit_modal");
    }





}
