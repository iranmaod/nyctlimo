<?php
include_once("inc/header.php");
?>


<!-- home page top banner -->
<!-- ["assets/img/slide-3.jpg", "assets/img/slide-2.jpg", "assets/img/slide-1.jpg"] -->

<div class="main-top-section">

    <div id="slider-div"
        data-zs-src='["assets/img/zoom_1.jpg", "assets/img/zoom_2.jpg","assets/img/zoom_3.jpg", "assets/img/zoom_4.jpg"]'
        data-zs-overlay="dots">
        <div class="slider-content">
            <h1>NYCT LIMO, SUV, CAR AND VAN SERVICES IN NEW YORK CONNECTICUT, BOSTON MA</h1>
            <div class="booknow">
                <a href="reservation.php" class="get-started-btn booknow-btn">BOOK NOW</a>
            </div>
            <div class="slider-content-p">
                <h2>Reliable and best airport service</h2>
            </div>
        </div>
    </div>
</div>

<div class="section our-services">
    <div class="container">
        <div class="row">
            <?php echo str_replace("services.php", "reservation.php", $service_text); ?>
            <!--
            <div class="our-services-top-heading">
                <h2>OUR SERVICES</h2>
            </div>
            <div class="our-services-heading">
                <h2>NYCT Limo Transportation Service</h2>
            </div>
            <div class="our-services-desc">
                <p>NYCT Limo offers a series of Connecticut limo services related to limo and car rental, thanks to
                    years of experience in the sector.</p>
            </div>
            <div class="card">
                <a href="services.php"><img src="assets/img/wedding-transportation.jpg" class="card-img-top"
                        alt="card-img-top"></a>
                <div class="card-body">
                    <h5 class="card-title"><a href="services.php">Wedding Limo Service</a></h5>
                    <p class="card-text">We offer a very high-quality limo service NYCT to nyc to add a touch of class
                        to
                        your most important occasions.
                    </p>
                </div>
            </div>
            <div class="card">
                <a href="services.php"><img src="assets/img/wedding-transportation.jpg" class="card-img-top"
                        alt="card-img-top"></a>
                <div class="card-body">
                    <h5 class="card-title"><a href="services.php">Airport Limo Service</a></h5>
                    <p class="card-text">Those from/to the airport are in great demand. Our Airport Limo service NYCT
                        are
                        appreciated for this type of service.
                    </p>
                </div>
            </div>
            <div class="card">
                <a href="services.php"><img src="assets/img/wedding-transportation.jpg" class="card-img-top"
                        alt="card-img-top"></a>
                <div class="card-body">
                    <h5 class="card-title"><a href="services.php">Charter Van, SUV Service</a></h5>
                    <p class="card-text">Those from/to the airport are in great demand. Our SUV, Charter Van service CT
                        are
                        appreciated for this type of service.
                    </p>
                </div>
            </div>
            <div class="card">
                <a href="services.php"><img src="assets/img/wedding-transportation.jpg" class="card-img-top"
                        alt="card-img-top"></a>
                <div class="card-body">
                    <h5 class="card-title"><a href="services.php">Car Service</a></h5>
                    <p class="card-text">Our staff can offer an elegant and classy Bradley airport car service that will
                        certainly give lustre and prominence to your image
                    </p>
                </div>
            </div>
            <div class="card">
                <a href="services.php"><img src="assets/img/wedding-transportation.jpg" class="card-img-top"
                        alt="card-img-top"></a>
                <div class="card-body">
                    <h5 class="card-title"><a href="services.php">Universities, Colleges Service</a></h5>
                    <p class="card-text">we also offer our NYCT Top Limousine Services to universities, colleges.We can
                        guarantee high-quality chauffeured rental services.
                    </p>
                </div>
            </div>
            <div class="card">
                <a href="services.php"><img src="assets/img/wedding-transportation.jpg" class="card-img-top"
                        alt="card-img-top"></a>
                <div class="card-body">
                    <h5 class="card-title"><a href="services.php">Offices, and Hotels Service</a></h5>
                    <p class="card-text">we also offer our NYCT Top Limousine Services to Offices, and Hotels.We can
                        guarantee high-quality chauffeured rental services.
                    </p>
                </div>
            </div>
            -->
        </div>
    </div>
</div>

<div class="section why-choose-us">
    <div class="background-overlay"></div>
    <div class="container">
        <div class="row">
            <?php echo $choose_text; ?>
            <!--
            <div class="choose-us-heading">
                <h2>Why Choose Us</h2>
            </div>
            <div class="choose-us-desc">
                <p>Regardless of your needs, we have the perfect choice of vehicles for you, and with our
                    professional chauffeurs, you will always feel safe and secure when traveling with us. Limo
                    Service in New York City</p>
            </div>
            <div class="d-flex flex-wrap col-12">
                <div class="icon-and-text col-md-6 d-flex">
                    <div class="choose-us-icon">
                        <span><i class="bi bi-headset"></i></span>
                    </div>
                    <div class="choose-us-text">
                        <h3>Full Service</h3>
                        <p>Whether its a short or long ride, you can count on us! We provide services to/from JFK,
                            LGA, EWR and many other airports.</p>
                    </div>
                </div>
                <div class="icon-and-text col-md-6 d-flex">
                    <div class="choose-us-icon">
                        <span><i class="bi bi-headset"></i></span>
                    </div>
                    <div class="choose-us-text">
                        <h3>Largest Fleet</h3>
                        <p>We have the largest fleet of well-maintained vehicles including Sedans, SUVs, and Sprinter
                            Vans</p>
                    </div>
                </div>
                <div class="icon-and-text col-md-6 d-flex">
                    <div class="choose-us-icon">
                        <span><i class="bi bi-headset"></i></span>
                    </div>
                    <div class="choose-us-text">
                        <h3>24x7 Live Support</h3>
                        <p>Need to make a last minute reservation or make a change to a existing one? We're available
                            24x7, contact us anytime!</p>
                    </div>
                </div>
                <div class="icon-and-text col-md-6 d-flex">
                    <div class="choose-us-icon">
                        <span><i class="bi bi-headset"></i></span>
                    </div>
                    <div class="choose-us-text">
                        <h3>Professional Chauffeurs</h3>
                        <p>Our professional chauffeurs will make your airport transfer & corporate service an
                            unforgetable experience</p>
                    </div>
                </div>
            </div>
            -->
        </div>
    </div>
</div>

<div class="section our-fleet">
    <div class="container">
        <div class="row">
            <?php echo $vehicle_text; ?>
            <!--
            <div class="our-fleet-top-heading">
                <h2>OUR VEHICLES</h2>
            </div>
            <div class="our-fleet-heading">
                <h2>The Best Luxury Vehicles in Town</h2>
            </div>
            <div class="our-fleet-desc">
                <p>We can order a connecticut limo airport service of any capacity: from 8 to 30 people. All cars of the
                    Top NYCT Limo company are the latest models of the most luxurious limousines and are equipped with
                    everything necessary for a pleasant pastime, a bar, DVD / TV systems, an audio system, various types
                    of lighting, climate control, a starry sky and much more!</p>
            </div>
            <div class="our-fleet-slider">
                <div class="owl-carousel owl-theme">
                    <div class="item">
                        <img src="assets/img/limo1.jpg">
                    </div>
                    <div class="item">
                        <img src="assets/img/limo2.jpg">
                    </div>
                    <div class="item">
                        <img src="assets/img/limo3.jpg">
                    </div>
                    <div class="item">
                        <img src="assets/img/limo4.jpg">
                    </div>
                    <div class="item">
                        <img src="assets/img/limo5.jpg">
                    </div>
                    <div class="item">
                        <img src="assets/img/limo6.jpg">
                    </div>
                </div>
            </div>

            <div class="our-fleet-btn ">
                <a href="vehicles.php" class="get-started-btn">view all vehicles</a>
            </div>

            <div class=" devider-bar d-none">
                <div class="row">
                    <div class="bar"></div>
                </div>
            </div>
            -->
        </div>
    </div>
</div>

<div class="section quotes-form">
    <div class="background-overlay2"></div>
    <div class="container">
        <div class="row">
            <div class="quotes-form-top-heading">
                <h2>QUOTES & RESERVATIONS</h2>
            </div>
            <div class="quotes-form-heading">
                <h2>Get an Instant Quote Below</h2>
            </div>
            <div class="quotes-form-desc d-none">
                <h2>Complete the Form to View Photos & Prices Instantly</h2>
            </div>

            <form class="d-none">
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Example label</label>
                    <input type="text" class="form-control" id="formGroupExampleInput"
                        placeholder="Example input placeholder">
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Another label</label>
                    <input type="text" class="form-control" id="formGroupExampleInput2"
                        placeholder="Another input placeholder">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="inputdate" class="form-label">Date</label>
                        <input type="date" class="form-control" id="inputdate">
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label ">Password</label>
                        <input type="password" class="form-control" id="inputPassword4">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="inputState" class="form-label">State</label>
                        <select id="inputState" class="form-select">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="inputState" class="form-label">State</label>
                        <select id="inputState" class="form-select">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="email" class="form-control" id="inputEmail4">
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label ">Password</label>
                        <input type="password" class="form-control" id="inputPassword4">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="email" class="form-control" id="inputEmail4">
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label ">Password</label>
                        <input type="number" class="tel" id="phone">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Check me out
                        </label>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">Get Prices & Availability</button>
                </div>
                <div class="col-12 text-center">
                    Terms of Use
                </div>
            </form>

            <div class="col-md-12 text-center our-fleet-btn">
                <a href="reservation.php" class="get-started-btn">Get Reservation</a>
            </div>
        </div>
    </div>
</div>


<div class="section about-us">
    <div class="container">
        <div class="row">
            <?php echo $about_text; ?>
            <!--
            <div class="about-us-top-heading">
                <h2>ABOUT US</h2>
            </div>
            <div class="about-us-heading">
                <h2>New York's Top Limo Service</h2>
            </div>
            <div class="about-us-content col-md-12">
                <div class="row">
                    <div class="col-md-6 p-4">
                        <img src="assets/img/about-img.jpg">
                    </div>
                    <div class="col-md-6">
                        <div class="about-us-text">
                            <p>Top NYCT Limo is one of the top limo companies in NYCT for its fleet of modern and
                                avant-garde cars in Connecticut, Rohde Island, and the area around Boston and New York
                                City. Top NYCT Limo's vehicles are treated in detail; their interiors are presented with
                                optical fibres and starry sky, with TV service and all the comforts that luxury cars
                                require.</p>
                            <p>All Limousines are always ready for every type of need at unique prices for the Territory
                                of Connecticut, Rohde Island, the area around Boston, and New York City. The cars are
                                equipped with a regular rental license with the driver, so we can take you to every
                                corner of the city, making you enjoy unrivalled squares for other unlicensed cars.</p>
                            <p>We have been operating in the sector for several years; our main goal is total customer
                                satisfaction; therefore, experience and professionalism are our watchwords. We provide
                                our customers with a wide range of classy Limo services at competitive rates.</p>
                        </div>
                        <div class="about-us-btn ">
                            <a href="about-us.php" class="get-started-btn">LEARN MORE ABOUT OUR COMPANY</a>
                        </div>
                    </div>
                </div>
            </div>
            -->
        </div>
    </div>
</div>

<div class="section testimonials">
    <div class="background-overlay2"></div>
    <div class="container">
        <div class="row">
            <div class="testimonials-top-heading">
                <h2>TESTIMONIALS</h2>
            </div>
            <div class="testimonials-heading">
                <h2>What Our Clients Say</h2>
            </div>
            <div class="testimonials-slider-div">
                <div class="owl-carousel testimonials-slider owl-theme">
                    <div class="item">
                        <div class="testimonials-content">
                            “I can confidently say that NYCT Limos has the finest car service in the city. You can
                            put your trust in them and expect on-time and reliable transportation. I will recommend
                            this to anyone who needs a chauffeured ride in the tri-state area.”
                        </div>
                        <div class="testimonials-name">John F.</div>
                        <div class="testimonials-title">Manager</div>
                    </div>
                    <div class="item">
                        <div class="testimonials-content">
                            “Their corporate transportation is one of the best I have ever experienced. I am so glad to
                            have found such a good company dedicated to its customers at this level. I will definitely
                            book your ride again when I visit the tri-state area!”
                        </div>
                        <div class="testimonials-name">Anna G.</div>
                        <div class="testimonials-title">Accountant</div>
                    </div>
                    <div class="item">
                        <div class="testimonials-content">
                            “I can confidently say that NYCT Limos has the finest car service in the city. You can put
                            your trust in them and expect on-time and reliable transportation. I will recommend this to
                            anyone who needs a chauffeured ride in the tri-state area.”
                        </div>
                        <div class="testimonials-name">John C.</div>
                        <div class="testimonials-title">Freelance</div>
                    </div>

                </div>
            </div>

            <div class=" testimonials-btn d-none">
                <a href="" class="get-started-btn">VIEW ALL TESTIMONIALS</a>
            </div>

        </div>
    </div>
</div>

<?php
//$blogs = $db->GetRow("SELECT * FROM `wp_posts` WHERE `post_status` = 'publish' ORDER BY `wp_posts`.`ID` DESC LIMIT 3");
?>

<div class="section blog">
    <div class="container">
        <div class="row">
            <div class="blog-top-heading">
                <h2>BLOG</h2>
            </div>
            <div class="blog-heading">
                <h2>Latest News</h2>
            </div>
            <div class="blog-content">
                <div class="row justify-content-between">
                    <?php
                    while(!$blogs->EOF) {
                        $post_id = $blogs->fields('ID');
                        $image = $db->GetRow("select guid from wp_posts where post_parent='$post_id' AND post_type = 'attachment' ");
                    ?>
                        <div class="card">
                            <a href="https://nyctlimo.com/blog/<?php echo $blogs->fields('post_name'); ?>">
                                <img src="<?php echo $image["guid"]; ?>" class="card-img-top" alt="card-img-top">
                            </a>
                            <div class="card-body">
                                <h3 class="card-title">
                                    <a href="https://nyctlimo.com/blog/<?php echo $blogs->fields('post_name'); ?>"><?php echo $blogs->fields('post_title'); ?></a>
                                </h3>
                                <p class="card-text">
                                    <?php
                                    echo substr($blogs->fields('post_content'), 0, 140);
                                    ?>
                                    ...
                                    <!-- If you haven’t given much thought to your teenager’s ride plans
                                    yet, you should make those plans in advance. Book a prom limo service in -->
                                </p>
                                <a href="https://nyctlimo.com/blog/<?php echo $blogs->fields('post_name'); ?>" class="read-more">Read More »</a>
                            </div>
                        </div>
                    <?php
                        $blogs->MoveNext();
                    }
                    $blogs->Close();
                    ?>
                    <!-- <div class="card">
                        <a href=""><img src="assets/img/wedding-transportation.jpg" class="card-img-top"
                                alt="card-img-top"></a>
                        <div class="card-body">
                            <h3 class="card-title"><a href="">Why Book a Limo for Prom: 5 Benefits</a></h3>
                            <p class="card-text">If you haven’t given much thought to your teenager’s ride plans
                                yet, you should make those plans in advance. Book a prom limo service in</p>
                            <a href="" class="read-more">Read More »</a>
                        </div>
                    </div>
                    <div class="card">
                        <a href=""><img src="assets/img/wedding-transportation.jpg" class="card-img-top"
                                alt="card-img-top"></a>
                        <div class="card-body">
                            <h3 class="card-title"><a href="">Why Book a Limo for Prom: 5 Benefits</a></h3>
                            <p class="card-text">If you haven’t given much thought to your teenager’s ride plans
                                yet, you should make those plans in advance. Book a prom limo service in</p>
                            <a href="" class="read-more">Read More »</a>
                        </div>
                    </div>
                    <div class="card">
                        <a href=""><img src="assets/img/wedding-transportation.jpg" class="card-img-top"
                                alt="card-img-top"></a>
                        <div class="card-body">
                            <h3 class="card-title"><a href="">Why Book a Limo for Prom: 5 Benefits</a></h3>
                            <p class="card-text">If you haven’t given much thought to your teenager’s ride plans
                                yet, you should make those plans in advance. Book a prom limo service in</p>
                            <a href="" class="read-more">Read More »</a>
                        </div>
                    </div> -->

                </div>
            </div>
        </div>
    </div>
</div>


<?php include_once("inc/footer.php") ?>