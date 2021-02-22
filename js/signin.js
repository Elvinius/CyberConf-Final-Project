// This JS code will clear the input of the signin modal when closing the modal
$("#elegantModalForm").on('hidden.bs.modal', function () {
    $(".page-signin input").val("");
});