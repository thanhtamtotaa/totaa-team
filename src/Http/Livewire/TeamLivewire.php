<?php

namespace Totaa\TotaaTeam\Http\Livewire;

use Livewire\Component;
use Auth;

class TeamLivewire extends Component
{
    /**
     * Các biến sử dụng trong Component
     *
     * @var mixed
     */
    public $name, $description, $group, $order, $team_id = NULL;
    public $name_arrays, $modal_title;

    /**
     * Cho phép cập nhật updateMode
     *
     * @var bool
     */
    public $updateMode = false;

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
            'description' => 'required',
            'group' => 'nullable',
            'order' => 'required|numeric|min:0',
        ];
    }

    public function render()
    {
        return view('totaa-team::livewire.team-livewire');
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
        $this->dispatchBrowserEvent('hide_modal');
    }







}
