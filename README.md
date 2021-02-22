# CyberConf

## The Event Management Website Created for Coursework Project of Taltech

## Setup

The project has been made by using Front-End technologies, such as HTML, CSS, Bootstrap, and JS, the backend server-side language PHP, and MySQL database language. <br>

### The Detailed Explanation is divided into Front/Back-End Part below

# *Front-End Explanation* 

## *Location*

- /views

HTML files are located under views directory with index.html being the home page. <br>

- /css

CSS and Bootstrap CSS files are under the css directory with the main.css including the main custom styles imported in other page style files. 

- /js

Custom Javascript files together with Bootstrap JS files are located under this directory. 

- / images

Images used for the project are located under this directory

## *Notable UI features and elements*

In the contact.html, Google Maps API was used to show the map of the conference venue. The following JS and HTML codes have been used to achieve the result:

```
HTML code
<div class="m-xl-5 col-md-5 m-sm-3 card pr-0 pl-0 venue-details">
            <div id="map"></div>
            <div class="card-body">
                <p class="card-text text-dark"><strong>CyberConf Conference Hall</strong><br>
                    Akadeemia tee 5, 12611 Tallinn <br>
                    tel 623 4004<br>
                    info@cyberconf.ee
                </p>
            </div>
        </div>
        
<script async type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATsjaQI2K7G88zrQrSfG6y75B5PcMvmSs&libraries=places&callback=initMap"></script>
        
//JS code

function initMap() {
    var cyberconf = {lat: 59.396590, lng: 24.667810};
    var map = new google.maps.Map(
    document.getElementById('map'), {zoom: 12, center: cyberconf});
    var marker = new google.maps.Marker({position: cyberconf, map: map});
}

```

The countdown displayed in the home page has been achieved with the help of the following codes:

```
//HTML code

 <div id="countdown-div" class="container mt-2">
            <div>
                <span class="days" id="day"></span>
                <div class="smalltext">Days</div>
            </div>
            <div>
                <span class="hours" id="hour"></span>
                <div class="smalltext">Hours</div>
            </div>
            <div>
                <span class="minutes" id="minute"></span>
                <div class="smalltext">Minutes</div>
            </div>
            <div>
                <span class="seconds" id="second"></span>
                <div class="smalltext">Seconds</div>
            </div>
        </div>
        <p id="final-text"></p>
    </div>

JS code

let countdownFunction = setInterval(function(){
	let currentDate = new Date().getTime();
	let remainingTime = conferenceDate - currentDate;
	let days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
	let hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24))/(1000*60* 60));
	let minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
	let seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);
	document.getElementById("day").innerHTML = days;
	document.getElementById("hour").innerHTML = hours;
	document.getElementById("minute").innerHTML = minutes;
	document.getElementById("second").innerHTML = seconds;
	if(remainingTime < 0 ) {
		clearInterval(countdownFunction);
		document.getElementById("final-text").innerHTML = "The Conference time has arrived!";

	}
}, 1000);
```
Ticket payment portal was created with the use of Bootstrap modals and Bootstrap validation has been used for the input validation:

```
HTML code

<div class="modal-body conference-ticket-payment">
                        <form action="../backend/buy_ticket.php" method="post" novalidate="novalidate"
                              class="needs-validation">
                            <!-- needs-validation class will activate the Bootstrap validation-->
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Payment amount</label>
                                <select id="cc-payment" name="cc-payment" type="text" class="form-control" required
                                        pattern="\d*" min="50" max="150" aria-required="true" aria-invalid="false">
                                    <option name="cc-payment" value="50">50</option>
                                    <option name="cc-payment" value="100">100</option>
                                    <option name="cc-payment" value="150">150</option>
                                </select>
                                <span class="invalid-feedback">Enter the payment amount</span>
                                <!-- invalid feedback class will display the error message in the case of the validation error-->
                            </div>
                            <div class="form-group has-success">
                                <label for="cc-name" class="control-label mb-1">Name on card</label>
                                <input id="cc-name" name="cc-name" type="text" class="form-control cc-name" required
                                       autocomplete="cc-name" aria-required="true" aria-invalid="false"
                                       aria-describedby="cc-name-error">
                                <span class="invalid-feedback">Enter the name as shown on credit card</span>
                            </div>
                            <div class="form-group">
                                <label for="cc-number" class="control-label mb-1">Card number</label>
                                <input id="cc-number" name="cc-number" type="tel"
                                       class="form-control cc-number identified visa" required="" pattern="[0-9]{16}">
                                <span class="invalid-feedback">Enter a valid 16 digit card number</span>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="cc-exp" class="control-label mb-1">Expiration</label>
                                        <input id="cc-exp" name="cc-exp" type="tel" class="form-control cc-exp" required
                                               placeholder="MM / YY" autocomplete="cc-exp">
                                        <span class="invalid-feedback">Enter the expiration date</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="x_card_code" class="control-label mb-1">Security code</label>
                                    <div class="input-group">
                                        <input id="x_card_code" name="x_card_code" type="tel"
                                               class="form-control cc-cvc" required autocomplete="off">
                                        <span class="invalid-feedback order-last">Enter the 3-digit code on back</span>
                                        <div class="input-group-append">
                                            <div class="input-group-text ">
                                              <span class="fa fa-question-circle fa-lg" data-toggle="popover"
                                                    data-container="body" data-html="true"
                                                    data-title="<span class='text-dark'>Security Code<span>"
                                                    data-content="<div class='text-center text-dark one-card'>The 3 digit code on the back of the card</div>"
                                                    data-trigger="hover"></span>
                                                <!--This code will show the popover text when bringing the cursor over the question sign in the Security code field -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="btn btn-lg btn-info btn-block" id="payment-button" data-target="#confirmationModal" data-toggle="modal"><i
                                                class="fa fa-lock fa-lg"></i>&nbsp; <span class="h3">Pay</span></button>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content border-warning">
                                            <div class="modal-header bg-warning text-light ">
                                                <h5 class="modal-title" id="exampleModalLabel">Are you sure to proceed?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                                <button type="submit" href="index.html" id="confirmation-button" class="btn btn-primary">Yes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>


JS code

//Below code enforces popover functionality in the payment section
$(function () {
    $('[data-toggle="popover"]').popover()
});

//to enforce the Bootstrap payment validation use the following code
$("#confirmation-button").click(function (e) {

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
```

## *Screenshots from the pages*

![CyberConf contact section](https://gitlab.cs.ttu.ee/abelvi/CyberConf/blob/master/cc-contact.png) <br>
![CyberConf ticket payment modal](https://gitlab.cs.ttu.ee/abelvi/CyberConf/blob/master/cc-ticketpayment.png) <br>
![CyberConf countdown](https://gitlab.cs.ttu.ee/abelvi/CyberConf/blob/master/cc-countdown.png) <br>

# *Back-End Explanation*

## *Location*


- /Backend

This directory located under the root directory 

It contain php files that are directly refered by front-side html in /views. 

- /Backend/model

There is directory located under "backend" tree.

These files are backbourne of functionality of backend.

Their functions are described below, will be explained in detail later
```
├── model
│   ├── BuyTicketHandle.php
│   ├── ProfileHandle.php
│   ├── RegisterHandle.php
│   ├── SessionControlHandle.php
│   └── SigninHandle.php
├── buy_ticket.php
├── database.php
├── logout.php
├── profile.php
├── register.php
├── session.php
└── signin.php
```
- Registration
- Sign in   
- Purchase of an item
- Profile 
- Session Checker


## model 

General reference of class: 
``` 
require 'Handle.php'
$main = New Handle;
$main->call();
```
General Structure of class :
```
class Handle {
    public function call ();{
        $this->process1();
        $this->process2();
        return ErrorCode;
    }
    private function process1();
    private function process2();
} 
```

Every file has class of its own name of file.
Except one function that can be called outside class are private because these are function that handle credentials and must not be exposed to outside its own class. call() will return error code as to make it easier to implement what kind of action to be taken depending on the error. Herebelow is ErrorCode.

```
#define SUCCESS 0 Private Function excuted
#define INPUTFL 1 Input is failed
#define SQLCONNFL  2 Connection to SQL database failed
#define REGFL   3 Registration failed
#define LOGFL   4 Loggin failed
#define SESSFL  5 Session failed
#define NULL 13 Returns a null object
#define FINISH 20 The Entire Program is complete without errors
```
This must be carefully read and referred, otherwise won't work.



## *Security Features*

###  *Always HTTPS*

In order to not to show plain text of the ongoing traffic data between client and server, I made sure to use POST when sending data.

####### I forgot to add a function to check something like $_SERVER["REQUEST_METHOD"] == 'POST' but I guess I will not add it now. Maybe later

### *Sanitizing Input*

In order to prevent simple javascript injection, strip_tags() is used.

This will remove tags character such as '<', '>', '&', ';' and other operators that allow excution of javascript. It still allows certain tags like ```<b> <i>``` so it is still not entirely secure yet. 


### *Use of prepared statement of PDO (PHP Data Objects)*

PDO extension defineds lightweight, adaptable interface for accessing various platform of databases.  PDO excute SQL statement with two steps of preparement and excution. By separating user-input and SQL statement, All user-input will be first converted into string type in first place. Special Characters are added with '\' in order to prevent SQL injection (equivalent to function addslash() ). After, these strings will replace the placeholder in SQL statement. placeholders are ```? or :blahblah``` in SQL statement to bind the user-input with. The variable must not be used, because they will be directly inserted into SQL statement. 

Example SQL :
```INSERT INTO table (user) VALUES (:user)```

prepare statement:
```$this->PDOobj->prepare(code above)```


Inserting user input to placeholder :``` $this->PDOobj->bindParam(':user',input,PDO::DATA_TYPE)```


### Session Control ###

We use cookie to validate user is dangerous since cookie can be modified.
Hence, we don't use cookie to validate any form. Instead, session is used.


