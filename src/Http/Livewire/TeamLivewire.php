<?php

namespace Totaa\TotaaTeam\Http\Livewire;

use Livewire\Component;
use Auth;
use Totaa\TotaaTeam\Models\TeamType;

class TeamLivewire extends Component
{
    /**
     * Các biến sử dụng trong Component
     *
     * @var mixed
     */
    public $team_id, $name, $team_type_id, $main_team_id, $nhom_kd_id, $order, $active, $created_by;
    public $bfo_info, $modal_title, $team_type_arrays;

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
