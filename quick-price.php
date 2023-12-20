<?php
include_once("inc/header.php");
?>

<style>
    @media (max-width:480px)  {
        .quick-page-text-img img {
            display: none;
        }
    }
</style>
<div class=" header-banner" style="background-image: url(assets/img/slide-2.jpg);">
    <div class="background-overlay3"></div>
    <div class="container">
        <div class="row">
            <div class="header-banner-content" style="min-height:60px;">
                <h1 style="display:none;">Quick Price</h1>
            </div>
        </div>
    </div>
</div>

<div class="section quick-price-page bg-white " style="padding-top: 20px;">
    <div class="container">
        <div class="row">

            <div class=" contact-us col-md-12">
                <div class="row">
                    <div class="col-md-6 mb-3 quick-page-text-img">
                        <div class="about-us-heading">
                            <h2 class="text-start">Quick Price</h2>
                        </div>
                        <div class="contact-info  align-items-center" id="quick-price-page">
                            <p>Select your vehicle type, point of origin and destination. Please contact us directly for
                                Pricing not included in this Quick Price tool. You can also give us a call at
                                1959.217.3600</p>
                        </div>
                        <img src="assets/img/about-img-1.jpg">
                    </div>
                     
                    <div class="col-md-6 d-flex flex-wrap align-content-around">
                        <?php
                            if (
                                (isset($_POST['vehicle_id']) && $_POST['vehicle_id'] != "")
                                && (isset($_POST['pickup']) && $_POST['pickup'] != "")
                                && (isset($_POST['dropoff']) && $_POST['dropoff'] != "")
                                && (isset($_POST['distance']) && $_POST['distance'] != "")
                            ) {

                            extract($_POST);
                            $vehicle = $db->GetRow("select * from doc_vehicles where id='" . $_POST['vehicle_id'] . "'");

                            $additional_charges = 0.00;
                            $tax_price = 0.00;
                            $distancePrice = ($distance > 30) ? ($vehicle['price'] + ( ($distance-30) * $vehicle['mile'] )) : $vehicle['price'];
                            $gratuity = round($distancePrice * (20 / 100),2);
                            $estimated_total = $distancePrice + $tax_price + $additional_charges + $gratuity;
                            ?>

                            <div class="rate_table">
                                <p class="text-start">
                                    Your estimated rate for a <strong><?php echo $vehicle["name"]; ?></strong> 
                                    from <strong><?= $_POST['pickup']; ?></strong> 
                                    to <strong><?= $_POST['dropoff']; ?></strong> 
                                    (distance <strong><?= $_POST['distance']; ?></strong> Miles)
                                </p>

                                <ul>
                                    <li><b>Base Rate</b><p>$<?php echo $vehicle['price']?></p></li>
                                    <li><b>Sub Total</b><p>$<?php echo number_format($distancePrice, 2); ?></p></li>
                                    <li><b>Gratuity</b><p>$<?php echo number_format($gratuity, 2)?></p></li>
                                    <li><b>Tax</b><p>$0</p></li>
                                    <li><b>Additional Charge(s)</b><p>$0</p></li>
                                    <li><b>Estimated Total</b><p>$<?php echo $estimated_total?></p></li>
                                        
                                </ul>
                            </div>
                        <?php } ?>

                        <form method="POST" action="">
                            <div class="mb-3">
                                <select class="form-select form-control" aria-label="Default select example">
                                    <option value="1">Pick Up - Drop Off</option>
                                    <option value="2">Drop Off - Pick Up</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <select name="vehicle_id" class="form-select form-control" aria-label="Default select example">
                                    <option selected>Select Vehicle</option>
                                    <?php getOptionsTable('vehicles', $vehicle_id); ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="text" id="pickup" name="pickup" placeholder="Enter Pick Up Location" maxlength="25" size="20" class="form-select form-control" />
                            </div>
                            <div class="mb-3">
                                <input type="text" id="dropoff" name="dropoff" placeholder="Enter Drop Off Location" maxlength="25" size="20" class="form-select form-control" />
                            </div>
                            <input type="hidden" name="distance" id="distance_miles" value="0" />
                            <div class="mb-3 d-none">
                                <p>This form collects your name, phone, and email so that we can correspond with you.
                                    Check out our <a href="">Privacy Policy</a> for more information.</p>
                            </div>
                            <div class="mb-3 form-btn">
                                <input type="submit" value="Get Price!" class="get-started-btn" style="width: 100%; margin-bottom:10px;" />
                                <a href="reservation.php" class="get-started-btn">Make Reservation!</a>
                            </div>
                        </form>

                        <div id="map" ></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyB4JyP0V5neIZXtWIcOxrhVlwWBk-SYFCE&callback=initMap&v=weekly" defer></script>
<script type="text/javascript">
    let map;

    let pickup = {
        lat: 0,
        lng: 0
    };

    let destination = {
        lat: 0,
        lng: 0
    };

    let distance = 0;

    function initMap() {
        const center = {
            lat: 40.774102,
            lng: -73.971734
        };
        const options = {
            zoom: 15,
            scaleControl: true,
            center: center
        };

        map = new google.maps.Map(document.getElementById('map'), options);

        var marker = new google.maps.Marker({
            position: center,
            map: map
        });

        // PICKUP LOCATION
        const pickupLocation = new google.maps.places.Autocomplete(document.getElementById("pickup"), {
            fields: ["formatted_address", "geometry", "name", "address_components"],
            strictBounds: false,
        });

        pickupLocation.bindTo("bounds", map);

        pickupLocation.addListener("place_changed", () => {
            const place = pickupLocation.getPlace();

            const components = place.address_components;
            components.forEach(function(item, index) {
                
            });


            if (!place.geometry || !place.geometry.location) {
                window.alert("No details available for input: '" + place.name + "'");
                return;
            }

            pickup.lat = place.geometry.location.lat();
            pickup.lng = place.geometry.location.lng();

            getDistance();
        });

        // DROPOFF LOCATION
        const dropoffLocation = new google.maps.places.Autocomplete(document.getElementById("dropoff"), {
            fields: ["formatted_address", "geometry", "name", "address_components"],
            strictBounds: false,
        });

        dropoffLocation.bindTo("bounds", map);

        dropoffLocation.addListener("place_changed", () => {
            const place = dropoffLocation.getPlace();

            const components = place.address_components;
            components.forEach(function(item, index) {
                
            });

            if (!place.geometry || !place.geometry.location) {
                window.alert("No details available for input: '" + place.name + "'");
                return;
            }

            destination.lat = place.geometry.location.lat();
            destination.lng = place.geometry.location.lng();

            getDistance();
        });
    }

    getDistance = () => {
        if (pickup.lat != 0 && pickup.lng && destination.lat != 0 && destination.lng) {
            let route = {
                origin: pickup,
                destination: destination,
                travelMode: 'DRIVING'
            }
            console.log('dropoff',route);

            new google.maps.DirectionsService().route(route,
                function(response, status) {
                if (status !== 'OK') {
                    window.alert('Directions request failed due to ' + status);
                    return;
                } else {
                    new google.maps.DirectionsRenderer().setDirections(response);
                    var directionsData = response.routes[0].legs[0];
                    console.log(directionsData);
                    if (!directionsData) {
                        window.alert('Directions request failed');
                        return;
                    } else {
                        let dis_mile = directionsData.distance.text;
                        document.getElementById('distance_miles').value = (dis_mile.split(" mi")[0]).replace(",", "");
                        distance = directionsData.distance.text;
                    }
                }
            });
        }
    }

    $(document).ready(function() {
        setTimeout(function() {
            if (/Mobi/.test(navigator.userAgent)) {
                console.log("in cond");
                document.querySelector("#quick-price-page").scrollIntoView({block: "start", behavior: "smooth"});
            }
        }, 1000);
    });
</script>

<?php include_once("inc/footer.php") ?>