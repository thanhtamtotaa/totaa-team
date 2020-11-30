
<div wire:ignore.self class="modal fade" id="set_team_member_modal" tabindex="-1" role="dialog" aria-labelledby="set_team_member_modal" aria-hidden="true" data-toggle="modal" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content py-2">
            <div class="modal-header">
                <h4 class="modal-title text-purple"><span class="fas fa-users mr-3"></span>{{ $modal_title }}</h4>
                <button type="button" wire:click.prevent="cancel()" class="close" data-dismiss="modal" wire:loading.attr="disabled" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="container-fluid mx-0 px-0">
                    <form>
                        <div class="row">

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="name">Tên nhóm:</label>
                                    <div>
                                        <span type="text" class="form-control px-2 h-auto">{{ $name }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="members">Thành viên:</label>
                                    <div class="select2-success" id="members_div">
                                        <select class="form-control px-2 select2-totaa" multiple totaa-placeholder="Thành viên ..." totaa-search="10" wire:model="members" id="members" style="width: 100%">
                                            @if (!!optional($bfo_info_arrays)->count())
                                                @foreach ($bfo_info_arrays as $bfo_info_array)
                                                    <option value="{{ $bfo_info_array->mnv }}">[{{ $bfo_info_array->mnv }}] {{ $bfo_info_array->full_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('members')
                                        <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>



                        </div>
                    </form>
                </div>
            </div>

            <div class="modal-footer mx-auto">
                <button wire:click.prevent="cancel()" class="btn btn-danger" wire:loading.attr="disabled" data-dismiss="modal">Đóng</button>
                <button wire:click.prevent="save_team_member()" class="btn btn-success" wire:loading.attr="disabled">Xác nhận</button>
            </div>

        </div>
    </div>

</div>
