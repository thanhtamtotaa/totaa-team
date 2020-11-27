
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

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="team_type_id">Phân loại nhóm:</label>
                                    <div id="team_type_id_div">
                                        <select class="form-control px-2 select2-totaa" totaa-placeholder="Phân loại nhóm ..." totaa-search="10" wire:model="team_type_id" id="team_type_id" style="width: 100%">
                                            <option selected></option>
                                            @if (!!count($team_type_arrays))
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
