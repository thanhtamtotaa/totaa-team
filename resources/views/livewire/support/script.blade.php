<script>

    //Ẩn toàn bộ modal
    window.addEventListener('hide_modal', function(e) {
        $(".modal.fade[style='display: block;']").modal("hide");
    })

    //Hiện modal cụ thể
    window.addEventListener('show_modal', event => {
        $(event.detail).modal("show");
    })

    $(document).on("click", "[wire\\:click\\.prevent='save_team()']", function() {
        ToTaa_BlockUI();
    });

    $(document).on("click", "[wire\\:click\\.prevent='save_team_member()']", function() {
        ToTaa_BlockUI();
    });

    //Toastr thông báo
    window.addEventListener('toastr', event => {
        toastr[event.detail.type](event.detail.message, event.detail.title, {
            positionClass: "toast-top-right",
            closeButton: true,
            progressBar: true,
            timeOut: 15000,
            extendedTimeOut: 2000,
            preventDuplicates: false,
            newestOnTop: true,
            rtl: $("body").attr("dir") === "rtl" ||
                $("html").attr("dir") === "rtl"
        });
    })

    //Block UI khi ấn thêm mới
    Livewire.on('add_team', function() {
        ToTaa_BlockUI();
    });

    //Gọi view xác nhận xóa
    $(document).on("click", "[totaa-edit-team]", function() {
        ToTaa_BlockUI();
        Livewire.emit('edit_team', $(this).attr("totaa-edit-team"));
    });

    //Gọi view set thành viên
    $(document).on("click", "[totaa-set-team-member]", function() {
        ToTaa_BlockUI();
        Livewire.emit('set_team_member', $(this).attr("totaa-set-team-member"));
    });

    //Xử lý khi dữ liệu đã được load xong
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook("message.processed", (message, component) => {
            $.unblockUI();

            if ($("select.select2-totaa").length != 0) {
                $("select.select2-totaa").each(function(e) {
                    $(this)
                    .wrap('<div class="position-relative"></div>')
                    .select2({
                        placeholder: $(this).attr("totaa-placeholder"),
                        minimumResultsForSearch: $(this).attr("totaa-search"),
                        dropdownParent: $("#" + $(this).attr("id") + "_div"),
                    });
                });
            }
        });
    });

    if ($("select.select2-totaa").length != 0) {
        $("select.select2-totaa").each(function(e) {
            $(this).on('select2:close', function (e) {
                console.log($(this).val());
                @this.set($(this).attr("wire:model"), $(this).val());
            });
        });
    }

</script>
