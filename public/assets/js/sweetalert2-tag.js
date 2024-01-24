function confirmDeleteTag(event) {
    event.preventDefault();
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
        title: 'Bạn muốn xóa Tag này chứ?',
        text: "Khi xóa Tag sẽ bị mất!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Có!',
        cancelButtonText: 'Không!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            swalWithBootstrapButtons.fire(
                'Deleted!',
                'Bạn đã xóa thành công.',
                'success'
            )
            event.target.submit();
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'Cancelled',
                'Tag đã không bị xóa :)',
                'error'
            )

        }
    })
}

$(document).ready(function () {
    // Bắt sự kiện submit form Thêm Tag
    $('#addTagForm').submit(function (event) {
        event.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var data = form.serialize();
        jQuery.support.cors = true;
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function (response) {
                $('#basicModal').modal('hide');
                location.reload();
            },
            error: function (xhr) {
                var errors = xhr.responseJSON.errors;
                var errorMsg = '';
                $.each(errors, function (key, value) {
                    errorMsg += value + '<br>';
                });
                $('#addTagErrorMsg').html(errorMsg).show();
            }
        });
    });

    // Bắt sự kiện hiển thị modal "Sửa Tag"
    $(document).ready(function () {
        $('#editTagModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('bs-id');
            var name = button.data('bs-name');
            var slug = button.data('bs-slug');
            var modal = $(this);
            modal.find('.modal-body form').attr('action', '/tags/' + id+'/edit');
            $('#editTagModal input[name="tag_name"]').val(name);
            $('#editTagModal input[name="tag_slug"]').val(slug);
            // console.log(name);
        });
    });
});
