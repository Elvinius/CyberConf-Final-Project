<?php

require "model/ProfileHandle.php";
require "model/SessionControlHandle.php";

function p()
{

    $main = (new ProfileHandle);
    $profile = $main->Profile();

    $fn = htmlspecialchars($profile['full_name']);
    $e = htmlspecialchars($profile['email']);
    $rt = htmlspecialchars(date("Y-m-d", strtotime($profile['register_time'])));
    $edu = htmlspecialchars($profile['education']);
    $ct = htmlspecialchars($profile['country']);
    if ($profile['ticket_type'] === 0) {
        $t = 'Have not purchased yet';
    } else {
        $t = $profile["ticket_type"];
    }

    $html = "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE-edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <meta name='author' content='Elvin Abbasli, Seho Tanaka'>
        <meta name='keywords' content='CyberConf, conferences, IT events, Cyber Security'>
        <meta name='no-email-collection' content='http://www.unspam.com/noemailcollection/'>
        <title>CyberConf 2020 | My profile</title>
        <link rel='icon' href='../images/logo-secondv.png' sizes='48x48' type='image/png'>
        <!-- to add the image to the title bar -->
        <link rel='stylesheet' type='text/css' href='../css/bootstrap.min.css'> <!-- bootstrap link -->
        <link rel='stylesheet' type='text/css' href='../css/profile.css'> <!-- main css style link -->
        <script src='https://kit.fontawesome.com/942ca677f7.js' crossorigin='anonymous'></script>
        <link href='https://fonts.googleapis.com/css?family=Quicksand:300,500' rel='stylesheet'>
    </head>

    <body>
    <header>
        <nav class='navbar navbar-expand-lg navbar-light'>
            <a href='index.html'>
                <img id='logo-img' src='../images/logo-secondv.png' width='30' height='30' alt='CyberConf Logo'>
            </a>
            <a class='navbar-brand' href='index.html'>
                <h1>CyberConf 2020</h1>
            </a>
            <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav'
                    aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
                <span class='navbar-toggler-icon'></span>
            </button>
            <div class='collapse navbar-collapse ml-4' id='navbarNav'>
                <ul class='navbar-nav nav ml-xl-5'>
                    <li class='nav-item'>
                        <a class='nav-link' href='index.html'>Home</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='about.html'>About</a>
                    </li>
                    <li class='nav-item active '><a class='nav-link' href='#profile.html'>Profile <span class='sr-only'>(current)</span></a> <!-- aims to hide an element to all devices except screen readers with .sr-only.  -->
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='schedules.html'>Schedules</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='tickets.html'>Tickets</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='register.html'>Register</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link contact' href='contact.html'>Contact</a>
                    </li>
                    <div>
                        <a href='../backend/logout.php' class='btn btn-info btn-rounded ml-xl-5'>Log out</a>
                    </div>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <div class='container bootstrap snippet'>
            <div class='row'>
                <div class='col-sm-12 col-md-8 col-xl-6'>
                    <ul class='list-group mb-2 mt-5'>
                        <li class='list-group-item text-muted'>Profile</li>
                        <li class='list-group-item text-left'><span class='pull-left'><strong>Registered :  </strong></span>$rt</li>
                        <li class='list-group-item text-left'><span class='pull-left'><strong>Full name :  </strong></span>$fn </li>
                        <li class='list-group-item text-left'><span class='pull-left'><strong>Email :  </strong></span>$e </li>
                        <li class='list-group-item text-text-left'><span class='pull-left'><strong>Country :  </strong></span>$ct</li>
                        <li class='list-group-item text-left'><span class='pull-left'><strong>Education :  </strong></span>$edu</li>
                    </ul>
                    <ul class='list-group mb-5'>
                        <li class='list-group-item text-muted'>Activity <i class='fa fa-dashboard fa-1x'></i></li>
                        <li class='list-group-item text-left'><span class='pull-left'><strong>Ticket : </strong></span>$t</li>
                    </ul>
                </div>
        </main>
    <footer class='page-footer'>
        <div id='contact-info'>
            <div class='container '>
                <div class='row pt-3'>
                    <section id='hours' class='col-sm-4'>
                        <h5>Hours:</h5>
                        Monday-Thurs: 10:00am - 08:00pm<br>
                        Fri: 11:00am - 4:30pm<br>
                        Saturday and Sunday Closed
                        <hr class='visible-xs'>
                    </section>
                    <section id='address' class='col-sm-4'>
                        <h5>Venue:</h5>
                        5 Akadeemia Road<br>
                        Tallinn, 12611
                        <p><span id='additional-contact-info'>* You can take trolley number 3 from the city centre or
                                    bus number 11 (the stop is Keemia).</span>
                        </p>
                        <hr class='visible-xs'>
                    </section>
                    <section id='contact' class='col-sm-4'>
                        <h5>Contact:</h5>
                        <p>Send us <a
                                    href='mailto:abelvi@ttu.ee?cc=setana@taltech.ee&subject=CyberConf%202020'>email</a> or
                            call us via +372 5845 6759.</p>
                        <hr class='visible-xs'>
                    </section>
                </div>
            </div>
        </div>
        <div class='clearfix'>
            <div class='col-md-6 text-sm-center mb-sm-3 mt-3 float-left copyright' style='background-size: cover;'>
                &copy;
                Copyright CyberConf 2020
            </div>
            <div class='col-md-6 text-right text-sm-center float-right mt-md-3 mb-sm-3' style='background-size: cover;'>
                <div class='social-icons text-dark '>
                    <a href=''>
                        <i class='fab fa-facebook fa-lg'></i>
                    </a>
                    <a href=''>
                        <i class='fab fa-linkedin fa-lg'></i>
                    </a>
                    <a href=''>
                        <i class='fab fa-instagram-square fa-lg'></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
    <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js'
            integrity='sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN'
            crossorigin='anonymous'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'
            integrity='sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q'
            crossorigin='anonymous'></script>
    <script src='../js/bootstrap.min.js'></script>
    </body>

    </html>";

    echo $html;
}

if (((new SessionControlHandle)->SessionControl() == 20)) {
    p();
    exit();
} else {
    header("location: ../views/index.html");    //echo "Session is not set";
}