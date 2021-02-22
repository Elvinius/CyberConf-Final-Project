//Below code enforces popover functionality in the payment section
$(function () {
    $('[data-toggle="popover"]').popover()
});

//to enforce the Bootstrap payment validation use the following code
$("#payment-button").click(function (e) {

    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    Array.prototype.filter.call(forms, function (form) {
        form.addEventListener('submit', function (event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
});

//use the below code to clear the payment input when closing the modal
$('#paymentModal').on('hidden.bs.modal', function (e) {
    $(".conference-ticket-payment input").val('');
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    Array.prototype.filter.call(forms, function (form) {
        form.classList.remove('was-validated');
    });
});


//disable the payment button so the users can not buy tickets after the start of the conference
let ticketButton = document.querySelectorAll(".tickets button");
let conferenceDate = new Date('Nov 05, 2020 10:00:00').getTime();

let currentDate = new Date().getTime();

if (conferenceDate - currentDate < 0) {

    for(let i=0; i<3; i++) {
        ticketButton[i].disabled = true;
    }
}
else {
    for(let i=0; i<3; i++) {
        ticketButton[i].disabled = false;
    }
}