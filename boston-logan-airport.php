<?php include_once("inc/header.php") ?>
<div class=" header-banner" style="background-image: url(assets/img/newark-airport-bg.jpg);">
    <div class="background-overlay3"></div>
    <div class="container">
        <div class="row">
            <div class="header-banner-content">
                <h1><?php echo $page["page_name"]; ?></h1>
            </div>
        </div>
    </div>
</div>

<div class="section service-detail bg-white">
    <div class="container">
        <div class="row">

            <div class=" col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <div class="about-us-heading ">
                            <h2 class="text-start"><?php echo $heading; ?></h2>
                        </div>
                        <?php echo $text; ?>
                        <!-- <div class="about-us-text ">
                            <p>Newark Airport (EWR) is your destination if you fly to the NYC metro area via corporate
                                or private aircraft. You will find this airport in Bergen County, New Jersey, located
                                about 12 miles from Manhattan. If you want to arrive as scheduled and not waste any time
                                before your flight, reserve an AGA Limousine Service vehicle. There will be a
                                comfortable vehicle waiting for you whether you are traveling alone or in a group.</p>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <a href="">
                                        <img src="assets/img/newark-airport-img2.jpg" class="card-img"
                                            alt="card-img-top">
                                    </a>
                                </div>
                            </div>
                            <div class="about-us-heading ">
                                <h2 class="text-start">WHY CHOOSE US?</h2>
                            </div>
                            <ul class="font-roboto ps-5">
                                <li>We provide first-class service and are open 24/7 all year round</li>
                                <li>Providing black car service at an affordable rate</li>
                                <li>We offer a speedy and reliable door-to-door service to and from every airport</li>
                                <li>Our chauffeurs monitor flights in real-time to ensure you’re picked up on time,
                                    every time!</li>
                                <li>Reliable communications between dispatch & chauffeurs via text message or by calling
                                </li>
                                <li>Array of luxury vehicles to transport you in comfort and style</li>
                                <li>Vaccinated chauffeurs at your service there, who also wear masks to ensure your
                                    safety from Covid-19.</li>
                            </ul>

                            <div class="about-us-heading ">
                                <h2 class="text-start">EWR AIRPORT PICKUP PROCEDURE</h2>
                            </div>

                            <p>Upon the arrival of your flight at Newark Airport, your chauffeur will call/text you to
                                coordinate the pickup. If you do not hear from the chauffeur after your flight arrival,
                                please call our office at (516) 703-9673 so we can direct you. Once you have grabbed
                                your checked-in luggage, you will follow the airport terminals signs that say “For Hire
                                Pickup” which will direct you on the right path to where you will find your chauffeur.
                                This applies to all Domestic and International Flights. If you would like an Inside
                                Pickup, please let out office know when making your reservation or prior to your
                                pick-up. If you would like more information on our Meet and Greet Service, click here.
                            </p>
                        </div>

                        <div class="about-us-heading mb-3 font-roboto text-dark">
                            <h5 class="text-center">OTHER AIRPORTS WE SERVED</h5>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <a href="">
                                    <img src="assets/img/wedding-transportation.jpg" class="card-img"
                                        alt="card-img-top">
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="">
                                    <img src="assets/img/wedding-transportation.jpg" class="card-img"
                                        alt="card-img-top">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="service-btn ">
                                <a href="vehicles.php" class="get-started-btn">VIEW OUR FULL FLEET</a>
                                <a href="reservation.php" class="get-started-btn">RESERVE YOUR CAR NOW</a>
                            </div>
                        </div> -->
                    </div>

                    <!-- side bar -->

                    <div class="col-md-4 sibebar-div">
                        <div class="sibebar-form">
                            <div class="sibebar-heading">
                                <h4>Quick Price And Make Reservation</h4>
                            </div>
                            <?php include_once("inc/book-a-ride-form.php") ?>
                            <!-- <form>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="formGroupExampleInput"
                                        placeholder="Your Name">
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" id="formGroupExampleInput"
                                        placeholder="Email">
                                </div>
                                <div class="mb-3">
                                    <input type="number" class="form-control" id="formGroupExampleInput"
                                        placeholder="Your Phone">
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="formGroupExampleInput"
                                        placeholder="Subject">
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" placeholder="Message"
                                        id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <p>This form collects your name, phone, and email so that we can correspond with
                                        you. Check out our <a href="">Privacy Policy</a> for more information.</p>
                                </div>
                                <div class="mb-3 form-btn">
                                    <a href="" class="get-started-btn">SUBMIT</a>
                                </div>
                            </form> -->
                        </div>

                        <!-- -2- -->
                        <div class="sibebar-list mt-3">
                            <div class="sibebar-heading">
                                <h4>AIRPORT TRANSFER SERVICES</h4>
                            </div>
                            <ul>
                                <li><a href="">John F. Kennedy Airport Transportation</a></li>
                                <li><a href="">LaGuardia Airport Transportation</a></li>
                                <li><a href="" class="active">Corporate Transportation</a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once("inc/footer.php") ?>