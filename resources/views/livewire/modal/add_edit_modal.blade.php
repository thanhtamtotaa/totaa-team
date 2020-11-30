
<div wire:ignore.self class="modal fade" id="add_edit_modal" tabindex="-1" role="dialog" aria-labelledby="add_edit_modal" aria-hidden="true" data-toggle="modal" data-backdrop="static" data-keyboard="false">

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
                                    <div id="name_div">
                                        <input type="text" class="form-control px-2" wire:model.lazy="name" id="name" style="width: 100%" placeholder="Tên nhóm ..." autocomplete="off">
                                    </div>
                                    @error('name')
                                        <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <pre>{{ var_dump($quanlys, $kenh_kd_arrays, $nhom_kd_arrays) }}</pre>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="team_type_id">Phân loại nhóm:</label>
                                    <div id="team_type_id_div">
                                        <select class="form-control px-2 select2-totaa" totaa-placeholder="Phân loại nhóm ..." totaa-search="10" wire:model="team_type_id" id="team_type_id" style="width: 100%">
                                            <option selected></option>
                                            @if (!!$team_type_arrays->count())
                                                @foreach ($team_type_arrays as $team_type_array)
                                                    <option value="{{ $team_type_array->id }}">{{ $team_type_array->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('team_type_id')
                                        <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="quanlys">Quản lý:</label>
                                    <div class="select2-success" id="quanlys_div">
                                        <select class="form-control px-2 select2-totaa" multiple totaa-placeholder="Quản lý ..." totaa-search="10" wire:model="quanlys" id="quanlys" style="width: 100%">
                                            @if (!!$bfo_info_arrays->count())
                                                @foreach ($bfo_info_arrays as $bfo_info_array)
                                                    <option value="{{ $bfo_info_array->mnv }}">[{{ $bfo_info_array->mnv }}] {{ $bfo_info_array->full_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('quanlys')
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
                <button wire:click.prevent="save()" class="btn btn-success" wire:loading.attr="disabled">Xác nhận</button>
            </div>

        </div>
    </div>

</div>
