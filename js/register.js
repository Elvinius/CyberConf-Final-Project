//Below code enforces popover functionality in the password section
$(function () {
    $('[data-toggle="popover"]').popover()
});

//to display the alert-danger message for four seconds
window.setTimeout(function() {
    $(".alert-danger").remove();
}, 4000);