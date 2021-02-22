<?php

require "model/BuyTicketHandle.php";

function t()
{

    session_start();
    $ticket_price = $_POST['cc-payment'];

    $main = (new Buy_TicketHandle($ticket_price));
    $result = $main->Buy_Ticket();

    if ($result == 20) {

        header("location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }
    return null;

}

t();
// returns 20 Success
// returns 2 Ticket price is not range 50-150
// returns 3 if buy ticket didn't work
// returns 7 if the user already has a ticket