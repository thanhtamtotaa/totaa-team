<script>

    //Ẩn toàn bộ modal
    window.addEventListener('hide_modal', function(e) {
        $("*").modal("hide");
    })

    //Hiện modal cụ thể
    window.addEventListener('show_modal', event => {
        $(event.detail).modal("show");
    })

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

    //Gọi view xác nhận xóa
        $(document).on("click", "[totaa-delete-team]", function() {
            ToTaa_BlockUI();
        Livewire.emit('delete_team', $(this).attr("totaa-delete-team"));
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
                        })
                        .on('select2:close', function (e) {
                            @this.set($(this).attr("wire:model"), $(this).val());
                        });
                });
            }
        });
    });

</script>
