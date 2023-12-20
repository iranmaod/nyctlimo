<?php
include_once("inc/header.php");

$page_id = 13;
$airlines = array(
    "Air Canada", "Air France", "Alitalia", "American Airlines", "British Airways", "Continental", "Delta", "Jet Blue", "Lufthansa", "Midway",
    "Northwest", "Southwest", "United", "US Airways", "Other"
);

$state_list = array('AL' => "Alabama", 'AK' => "Alaska", 'AZ' => "Arizona", 'AR' => "Arkansas", 'CA' => "California", 'CO' => "Colorado", 'CT' => "Connecticut", 'DE' => "Delaware",
    'DC' => "District Of Columbia", 'FL' => "Florida", 'GA' => "Georgia", 'HI' => "Hawaii", 'ID' => "Idaho", 'IL' => "Illinois", 'IN' => "Indiana", 'IA' => "Iowa",
    'KS' => "Kansas", 'KY' => "Kentucky", 'LA' => "Louisiana", 'ME' => "Maine", 'MD' => "Maryland", 'MA' => "Massachusetts", 'MI' => "Michigan", 'MN' => "Minnesota",
    'MS' => "Mississippi", 'MO' => "Missouri", 'MT' => "Montana", 'NE' => "Nebraska", 'NV' => "Nevada", 'NH' => "New Hampshire", 'NJ' => "New Jersey", 'NM' => "New Mexico",
    'NY' => "New York", 'NC' => "North Carolina", 'ND' => "North Dakota", 'OH' => "Ohio", 'OK' => "Oklahoma", 'OR' => "Oregon", 'PA' => "Pennsylvania", 'RI' => "Rhode Island",
    'SC' => "South Carolina", 'SD' => "South Dakota", 'TN' => "Tennessee", 'TX' => "Texas", 'UT' => "Utah", 'VT' => "Vermont", 'VA' => "Virginia", 'WA' => "Washington",
    'WV' => "West Virginia", 'WI' => "Wisconsin", 'WY' => "Wyoming");

$city = '';
$arrival_airport = '';
?>

<style>
    #couponerrors {
        color: red;
        margin-bottom: 15px;
        line-height: 20px;
        margin-top: 15px;
    }
    .header-banner-content {
        min-height: 70px;
    }
    .header-banner-content h1 {
        display: none;
    }
    .section {
        padding: unset;
    }
</style>

<div class=" header-banner" style="background-image: url(assets/img/slide-2.jpg);">
    <div class="background-overlay3"></div>
    <div class="container">
        <div class="row">
            <div class="header-banner-content">
                <h1>RESERVATIONS</h1>
            </div>
        </div>
    </div>
</div>


<div class="section" id="top_wrapper">
    <div id="container" class="container">
        <div id="mainContent2">
            <h3> Reservation</h3>
            <div class="tabs-menu-form-steps">
                <ul class="tabed-style">
                    <li class="s1 active">SERVICE DETAILS</li>
                    <li class="s2">REQUEST DETAILS</li>
                    <li class="s3">CONFIRM</li>
                </ul>
            </div>
            <div class="errors" id="errors"></div>

            <form method="POST" action="">
                <div class="search-veh step-1 basic" <?= (!empty($price) ? 'style="display: none;"' : ''); ?>>
                    <div class="res-sec-wrap left-area-wrapper">
                        <input name="save" type="hidden" id="save" value="true" />
                        <input name="drop_address" type="hidden" id="drop_address" value="Airport" />
                        <input name="trip" id="trip" type="hidden" value="One Way" />

                        <div class="element_wrapper">
                            <div class="label_wrapper" style=" width: 100%; font-weight: 700; ">Please click orange Button for service you need</div>
                            <div class="input_wrapper_2">
                                <button type="button" class="buttons desire_location2 active" id="desire_location2" data-ctype="1" >To Airport</button>
                                <button type="button" class="buttons desire_location2" id="desire_location2" data-ctype="2">From Airport</button>
                                <button type="button" class="buttons desire_location2" id="desire_location2" data-ctype="3">AirPort Round Trip</button>
                                <button type="button" class="buttons desire_location2" id="desire_location2" data-ctype="4">Point to Point Hourly Rate</button>

                                <select name="desire_location" id="desire_location" class="formselect" onChange="selLocation(this)" style="display: none;">
                                    <option value="1" <?= (rs(post('desire_location')) == 1 ? 'selected=selected' : ''); ?>>To Airport</option> 
                                    <option value="2" <?= (rs(post('desire_location')) == 2 ? 'selected=selected' : ''); ?>>From Airport</option>
                                    <option value="3" <?= (rs(post('desire_location')) == 3 ? 'selected=selected' : ''); ?>>AirPort Round Trip</option>
                                    <option value="4" <?= (rs(post('desire_location')) == 4 ? 'selected=selected' : ''); ?>>Hourly Rate Service</option>
                                </select>
                            </div>
                        </div>

                        <div class="element_wrapper">
                            <div class="label_wrapper">
                                Total Passengers:*
                            </div>
                            <div class="input_wrapper">
                                <input type="text" id="passengers" value="<?= rs(post('passengers')); ?>" name="passengers" class="formbox">
                            </div>
                        </div>

                        <div class="element_wrapper">
                            <div class="label_wrapper">
                                Pickup Date: *
                            </div>
                            <div class="input_wrapper">
                                <input id="departure_date" type="date" value="<?= rs(post('departure_date')) ?>" name="departure_date" min="<?php echo date("Y-m-d"); ?>" class="formbox" />
                            </div>
                        </div>

                        <div class="element_wrapper">
                            <div class="label_wrapper">
                                Pick up time:
                            </div>
                            <div class="input_wrapper input_wrapper_2">
                                <select name="actual_pick_up_time" id="actual_pick_up_time">
                                    <option value="">Select Time</option>
                                    <?php
                                    $start = '00:00';
                                    $end = '23:45';

                                    $tStart = strtotime($start);
                                    $tEnd = strtotime($end);
                                    $tNow = $tStart;
                                    while ($tNow <= $tEnd) {
                                        echo '<option>' . date('h:i A', $tNow) . "</option>";
                                        $tNow = strtotime('+15 minutes', $tNow);
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="locwrapermain <?= (rs(post('desire_location')) == 3 ? 'type3' : 'type1'); ?>">
                            <div class="serviceHours element_wrapper">
                                <div class="label_wrapper">
                                    Service hours:
                                </div>
                                <div class="input_wrapper">
                                    <input type="text" id="shours" value="<?= (!empty(rs(post('shours'))) ? rs(post('shours')) : '5'); ?>" name="shours" class="formbox">
                                </div>
                            </div>
                            <div class="loc1">
                                <div class="element_wrapper detailloc">
                                    <div class="label_wrapper">
                                        Pickup From Address
                                    </div>
                                    <div class="input_wrapper">

                                    </div>
                                </div>
                                <div class="element_wrapper">
                                    <div class="label_wrapper">
                                        Address:
                                    </div>
                                    <div class="input_wrapper">
                                        <input type="text" id="street" value="<?= rs(post('street')) ?>" name="street" maxlength="25" size="20" class="formbox" id="txtSecond">
                                    </div>
                                </div>
                                <div class="element_wrapper nCityField" style="display: none;">
                                    <div class="label_wrapper">
                                        City:
                                    </div>
                                    <div class="input_wrapper">
                                        <select name="city" size="1" class="formselect" id="city">
                                            <option value="Select City">Select City</option>
                                            <?php getOptionsTable('destinations', $city); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="element_wrapper hCityField" style="display: none;">
                                    <div class="label_wrapper">
                                        City:
                                    </div>
                                    <div class="input_wrapper">
                                        <input type="text" id="hCityField" value="<?= rs(post('hCityField')) ?>" name="hCityField" maxlength="25" size="20" class="formbox">
                                    </div>
                                </div>

                                <div class="element_wrapper" style="display: none;">
                                    <div class="label_wrapper">
                                        State/Zip:
                                    </div>
                                    <div class="input_wrapper input_wrapper_2">                                        
                                        <select name="state" id="state" size="1" class="formselect" style="width:130px; margin-right:10px !important"> 
                                            <option value="">Please Select ...</option>                                          
                                            <?php foreach ($state_list as $key => $val) { ?>
                                                <option value="<?= $val ?>" <?= (rs(post('state')) == $val ? 'selected=selected' : ''); ?>><?= $val ?></option>
                                                <?php
                                            }
                                            ?>                                          
                                        </select>
                                        <input type="text" value="<?= rs(post('zip')) ?>" name="zip" maxlength="25" size="15" class="formbox" style="width:100px !important;" id="zip"> 
                                    </div>
                                </div>
                            </div>
                            <div class="hdropoff">
                                <div class="element_wrapper">
                                    <div class="label_wrapper">
                                        Dropoff Address:
                                    </div>
                                    <div class="input_wrapper">

                                    </div>
                                </div>

                                <div class="element_wrapper">
                                    <div class="label_wrapper">
                                        Address:
                                    </div>
                                    <div class="input_wrapper">
                                        <input type="text" id="dstreet" value="<?= rs(post('hstreet')) ?>" name="dstreet" maxlength="25" size="20" class="formbox" readonly>
                                    </div>
                                </div>

                                <div class="element_wrapper nCityField" style="display: none;">
                                    <div class="label_wrapper">
                                        City:
                                    </div>
                                    <div class="input_wrapper">
                                        <select name="hcity" size="1" class="formselect" id="hcity">
                                            <option value="Select City">Select City</option>
                                            <?php getOptionsTable('destinations', $city); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="element_wrapper hCityField" style="display: none;">
                                    <div class="label_wrapper">
                                        City:
                                    </div>
                                    <div class="input_wrapper">
                                        <input type="text" id="hCityFielddrop" value="<?= rs(post('hCityFielddrop')) ?>" name="hCityFielddrop" maxlength="25" size="20" class="formbox">
                                    </div>
                                </div>

                                <div class="element_wrapper" style="display: none;">
                                    <div class="label_wrapper">
                                        State/Zip:
                                    </div>
                                    <div class="input_wrapper input_wrapper_2">                                        
                                        <select name="hstate" id="hstate" size="1" class="formselect" style="width:130px; margin-right:10px !important"> 
                                            <option value="">Please Select ...</option>                                          
                                            <?php foreach ($state_list as $key => $val) { ?>
                                                <option value="<?= $val ?>" <?= (rs(post('hstate')) == $val ? 'selected=selected' : ''); ?>><?= $val ?></option>
                                                <?php
                                            }
                                            ?>                                          
                                        </select>
                                        <input type="text" value="<?= rs(post('hzip')) ?>" name="hzip" maxlength="25" size="15" class="formbox" style="width:100px !important;" id="hzip"> 
                                    </div>
                                </div>
                            </div>


                            <div class="loc2">
                                <div class="element_wrapper airportloc">
                                    <div class="label_wrapper">
                                        Dropoff Address:
                                    </div>
                                    <div class="input_wrapper">

                                    </div>
                                </div>
                                <div class="element_wrapper airportlabel">
                                    <div class="label_wrapper">
                                        Address<!-- Airport: -->
                                    </div>
                                    <div class="input_wrapper">
                                        <input type="text" id="hstreet" value="<?= rs(post('hstreet')) ?>" name="dstreet" maxlength="25" size="20" class="formbox" id="txtSecond" readonly>
                                        <select name="arrival_airport" id="arrival_airport" size="1" class="formselect" onchange="airport(this, 'arrival');" style="display: none;"> 
                                            <option value="Select Airport">Select Airport</option>
                                            <?php getOptionsTable('airports', $arrival_airport); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="element_wrapper" style="display: none;">
                                    <div class="label_wrapper">
                                        Airline:
                                    </div>
                                    <div class="input_wrapper">
                                        <select name="departure_airline" size="1" class="formbox">
                                            <option value="Select Airline">Select Airline</option>
                                            <option value="Air Canada">Air Canada</option>
                                            <option value="Air France">Air France</option>
                                            <option value="Alitalia">Alitalia</option>
                                            <option value="American Airlines">American Airlines</option>
                                            <option value="British Airways">British Airways</option>
                                            <option value="Continental">Continental</option>
                                            <option value="Delta">Delta</option>
                                            <option value="Jet Blue">Jet Blue</option>
                                            <option value="Lufthansa">Lufthansa</option>
                                            <option value="Midway">Midway</option>
                                            <option value="Northwest">Northwest</option>
                                            <option value="Southwest">Southwest</option>
                                            <option value="United">United</option>
                                            <option value="US Airways">US Airways</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="element_wrapper" style="display: none;">
                                    <div class="label_wrapper">
                                        Flight #:
                                    </div>
                                    <div class="input_wrapper">
                                        <input type="text" id="flight_no" value="<?= rs(post('flight_no')) ?>" name="flight_no" class="formbox">
                                    </div>
                                </div>
                            </div>
                            
                            <?php include_once('extra_stop.php');?>

                            <div class="roundtripwrap loc3">
                                <div class="element_wrapper">
                                    <div class="label_wrapper">
                                        Return Pickup Date: *
                                    </div>
                                    <div class="input_wrapper">
                                        <input id="round_departure_date" type="date" value="<?= rs(post('round_departure_date')) ?>" name="round_departure_date" maxlength="25" size="20" class="formbox" />
                                    </div>
                                </div>

                                <div class="element_wrapper">
                                    <div class="label_wrapper">
                                        Return Pick up time:
                                    </div>
                                    <div class="input_wrapper input_wrapper_2">
                                        <select name="round_actual_pick_up_time" id="round_actual_pick_up_time" class="formbox">
                                            <option value="">Select Time</option>
                                            <?php
                                            $start = '00:00';
                                            $end = '23:45';

                                            $tStart = strtotime($start);
                                            $tEnd = strtotime($end);
                                            $tNow = $tStart;
                                            while ($tNow <= $tEnd) {
                                                echo '<option>' . date('h:i A', $tNow) . "</option>";
                                                $tNow = strtotime('+15 minutes', $tNow);
                                            }
                                            ?>
                                        </select>

                                    <!--                                                    
                                        <input type="text" name="round_actual_pick_up_time" id="round_actual_pick_up_time" maxlength="25" size="15" class="formbox" value="<?= rs(post('round_actual_pick_up_time')) ?>"/>
                                        <select name="round_actual_pick_up_time_am" id="round_actual_pick_up_time_am" size="1" class="formselect">
                                            <option value="AM">AM</option>
                                            <option value="PM">PM</option>
                                        </select>-->
                                    </div>
                                </div>
                                <div class="locwrapermain type1">
                                    <div class="roundloc2">
                                        <div class="element_wrapper roundairportloc" style="display: none;">
                                            <div class="label_wrapper">
                                                Return Address:
                                            </div>
                                            <div class="input_wrapper">

                                            </div>
                                        </div>
                                        <div class="element_wrapper">
                                            <div class="label_wrapper">
                                                Address<!-- Select Airport: -->
                                            </div>
                                            <div class="input_wrapper">
                                                <input type="text" id="round_arrival_airport" value="<?= rs(post('hstreet')) ?>" name="round_arrival_airport" maxlength="25" size="20" class="formbox" id="txtSecond">
                                                <!-- <select name="round_arrival_airport" id="round_arrival_airport" size="1" class="formselect" style="display: none;"> 
                                                    <option value="Select Airport">Select Airport</option>
                                                    <?php //getOptionsTable('airports', $round_arrival_airport); ?>
                                                </select> -->
                                            </div>
                                        </div>
                                    </div>    
                                    <div class="roundloc2">
                                        <div class="element_wrapper rounddetailloc">
                                            <div class="element_wrapper" style="display: none;">
                                                <div class="label_wrapper">
                                                    Airline:
                                                </div>
                                                <div class="input_wrapper">
                                                    <select name="round_departure_airline" size="1" class="formbox">
                                                        <option value="Select Airline">Select Airline</option>
                                                        <option value="Air Canada">Air Canada</option>
                                                        <option value="Air France">Air France</option>
                                                        <option value="Alitalia">Alitalia</option>
                                                        <option value="American Airlines">American Airlines</option>
                                                        <option value="British Airways">British Airways</option>
                                                        <option value="Continental">Continental</option>
                                                        <option value="Delta">Delta</option>
                                                        <option value="Jet Blue">Jet Blue</option>
                                                        <option value="Lufthansa">Lufthansa</option>
                                                        <option value="Midway">Midway</option>
                                                        <option value="Northwest">Northwest</option>
                                                        <option value="Southwest">Southwest</option>
                                                        <option value="United">United</option>
                                                        <option value="US Airways">US Airways</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="element_wrapper" style="display: none;">
                                                <div class="label_wrapper">
                                                    Flight #:
                                                </div>
                                                <div class="input_wrapper">
                                                    <input type="text" id="flight_no" value="<?= rs(post('flight_no')) ?>" name="round_flight_no" class="formbox">
                                                </div>
                                            </div>
                                            
                                            <?php include_once('round_extra_stop.php');?>
                                            
                                            <div class="label_wrapper">
                                                Return Drop Address:
                                            </div>
                                            <div class="input_wrapper">

                                            </div>
                                        </div>
                                        <div class="element_wrapper">
                                            <div class="label_wrapper">
                                                Address:
                                            </div>
                                            <div class="input_wrapper">
                                                <input type="text" id="round_street" value="<?= rs(post('round_street')) ?>" name="round_street" maxlength="25" size="20" class="formbox" id="txtSecond">
                                            </div>
                                        </div>
                                        <div class="element_wrapper" style="display: none;">
                                            <div class="label_wrapper">
                                                City:
                                            </div>
                                            <div class="input_wrapper">
                                                <select name="round_city" id="round_city" size="1" class="formselect">
                                                    <option value="Select City">Select City</option>
                                                    <?php getOptionsTable('destinations', $round_city); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="element_wrapper" style="display: none;">
                                            <div class="label_wrapper">
                                                State/Zip:
                                            </div>
                                            <div class="input_wrapper input_wrapper_2">                                        
                                                <select name="round_state" id="round_state" size="1" class="formselect" style="width:130px; margin-right:10px !important"> 
                                                    <option value="">Please Select ...</option>                                          
                                                    <?php foreach ($state_list as $key => $val) { ?>
                                                        <option value="<?= $val ?>" <?= (rs(post('round_state')) == $val ? 'selected=selected' : ''); ?>><?= $val ?></option>
                                                        <?php
                                                    }
                                                    ?>                                          
                                                </select>
                                                <input type="text" id="round_zip" value="<?= rs(post('round_zip')) ?>" name="round_zip" maxlength="25" size="15" class="formbox" style="width:100px !important;" > 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form_footer form_action">      
                            <input type="button" value="View Rates" name="getPrice" class="formbutton buttons getPrice" />
                        </div>
                    </div>
                    <div class="right-area-wrapper" >
                        <div class="map-div">
                            <div id="map" ></div>
                            <div id="msg"></div>
                            <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=&callback=initMap&v=weekly" defer></script>
                            <script type="text/javascript">
                                let map;
                                let distance = 0;
                                let duration = 0;
                                let extraStop = [];
                                let extraLatLng = [];
                                let pickup = {
                                    lat: 0,
                                    lng: 0
                                };
                                let destination = {
                                    lat: 0,
                                    lng: 0
                                };
                                let directionsRenderer;

                                let roundExtraStop = [];
                                let roundExtraLatLng = [];
                                let roundPickup = {
                                    lat: 0,
                                    lng: 0
                                };
                                let roundDestination = {
                                    lat: 0,
                                    lng: 0
                                };
                                let directionsRendererRound;

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
                                    directionsRenderer = new google.maps.DirectionsRenderer();
                                    directionsRenderer.setMap(map);

                                    directionsRendererRound = new google.maps.DirectionsRenderer();
                                    directionsRendererRound.setMap(map);

                                    var marker = new google.maps.Marker({
                                        position: center,
                                        map: map
                                    });

                                    // PICKUP LOCATION
                                    const autocomplete = new google.maps.places.Autocomplete(document.getElementById("street"), {
                                        fields: ["formatted_address", "geometry", "name", "address_components"],
                                        strictBounds: false,
                                    });

                                    autocomplete.bindTo("bounds", map);

                                    autocomplete.addListener("place_changed", () => {
                                        marker.setVisible(false);

                                        const place = autocomplete.getPlace();

                                        const components = place.address_components;
                                        components.forEach(function(item, index) {
                                            if ( item.types[0] == "locality" ) {
                                                document.getElementById("city").value = item.long_name;
                                                let selectElement = document.getElementById('city');

                                                [...selectElement.options].filter(function(c) {
                                                    if (c.text == item.long_name) {
                                                        document.getElementById("city").value = c.value;
                                                    } else {
                                                        document.getElementById("city").value = '24';
                                                    }
                                                });

                                                document.getElementById("hCityField").value = item.long_name;
                                            }
                                            if ( item.types[0] == "administrative_area_level_1" ) {
                                                document.getElementById("state").value = item.long_name;
                                            }
                                            if ( item.types[0] == "postal_code" ) {
                                                document.getElementById("zip").value = item.long_name;
                                            }
                                        });

                                        if (!place.geometry || !place.geometry.location) {
                                            window.alert("No details available for input: '" + place.name + "'");
                                            return;
                                        }

                                        if (place.geometry.viewport) {
                                            map.fitBounds(place.geometry.viewport);
                                        } else {
                                            map.setCenter(place.geometry.location);
                                            map.setZoom(17);
                                        }

                                        pickup.lat = place.geometry.location.lat();
                                        pickup.lng = place.geometry.location.lng();

                                        marker.setPosition(place.geometry.location);
                                        marker.setVisible(true);
                                        
                                        jQuery("#extra_street").removeAttr("readonly");
                                        jQuery("#extra_street").parent().find("span").remove();

                                        jQuery("#hstreet").removeAttr("readonly");
                                        jQuery("#hstreet").parent().find("span").remove();

                                        jQuery("#dstreet").removeAttr("readonly");
                                        jQuery("#dstreet").parent().find("span").remove();

                                    });

                                    // EXTRA STOP
                                    const extraStreet = new google.maps.places.Autocomplete(document.getElementById("extra_street"), {
                                        fields: ["formatted_address", "geometry", "name", "address_components"],
                                        strictBounds: false,
                                    });

                                    extraStreet.bindTo("bounds", map);

                                    extraStreet.addListener("place_changed", () => {
                                        const place = extraStreet.getPlace();
                                        const components = place.address_components;
                                        components.forEach(function(item, index) {
                                            if ( item.types[0] == "locality" ) {
                                                document.getElementById("extra_city").value = item.long_name;;
                                            }
                                            if ( item.types[0] == "administrative_area_level_1" ) {
                                                document.getElementById("extra_state").value = item.long_name;
                                            }
                                            if ( item.types[0] == "postal_code" ) {
                                                document.getElementById("extra_zip").value = item.long_name;
                                            }
                                        });

                                        if (!place.geometry || !place.geometry.location) {
                                            window.alert("No details available for input: '" + place.name + "'");
                                            return;
                                        }

                                        if (destination.lat == 0 && destination.lng == 0) {
                                            destination.lat = place.geometry.location.lat();
                                            destination.lng = place.geometry.location.lng();
                                            extraLatLng.push({
                                                lat: place.geometry.location.lat(),
                                                lng: place.geometry.location.lng(),
                                                location: place.formatted_address
                                            });
                                        } else {
                                            extraStop.push({
                                                location: place.formatted_address,
                                                stopover: true
                                            });
                                        }

                                        getDistance(directionsRenderer, map);
                                    });

                                    // DROPOFF LOCATION
                                    const dropoff = new google.maps.places.Autocomplete(document.getElementById("hstreet"), {
                                        fields: ["formatted_address", "geometry", "name", "address_components"],
                                        strictBounds: false,
                                    });

                                    dropoff.bindTo("bounds", map);

                                    dropoff.addListener("place_changed", () => {
                                        const place = dropoff.getPlace();

                                        const components = place.address_components;
                                        components.forEach(function(item, index) {
                                            if ( item.types[0] == "locality" ) {
                                                document.getElementById("hCityFielddrop").value = item.long_name;;
                                            }
                                            if ( item.types[0] == "administrative_area_level_1" ) {
                                                document.getElementById("hstate").value = item.long_name;
                                            }
                                            if ( item.types[0] == "postal_code" ) {
                                                document.getElementById("hzip").value = item.long_name;
                                            }
                                        });


                                        if (!place.geometry || !place.geometry.location) {
                                            window.alert("No details available for input: '" + place.name + "'");
                                            return;
                                        }

                                        Object.values(extraLatLng).some((v) => {
                                            if (v.lat === destination.lat && v.lng === destination.lng) {
                                                extraStop.push({
                                                    location: v.location,
                                                    stopover: true
                                                });
                                            }
                                        });

                                        destination.lat = place.geometry.location.lat();
                                        destination.lng = place.geometry.location.lng();

                                        getDistance(directionsRenderer, map);
                                    });

                                    // DROPOFF LOCATION
                                    const dropoffAddress = new google.maps.places.Autocomplete(document.getElementById("dstreet"), {
                                        fields: ["formatted_address", "geometry", "name", "address_components"],
                                        strictBounds: false,
                                    });

                                    dropoffAddress.bindTo("bounds", map);

                                    dropoffAddress.addListener("place_changed", () => {
                                        marker.setVisible(false);

                                        const place = dropoffAddress.getPlace();
                                        document.getElementById("hstreet").value = document.getElementById("dstreet").value;

                                        const components = place.address_components;
                                        components.forEach(function(item, index) {
                                            if ( item.types[0] == "locality" ) {
                                                document.getElementById("hCityFielddrop").value = item.long_name;;
                                            }
                                            if ( item.types[0] == "administrative_area_level_1" ) {
                                                document.getElementById("hstate").value = item.long_name;
                                            }
                                            if ( item.types[0] == "postal_code" ) {
                                                document.getElementById("hzip").value = item.long_name;
                                            }
                                        });


                                        if (!place.geometry || !place.geometry.location) {
                                            window.alert("No details available for input: '" + place.name + "'");
                                            return;
                                        }

                                        Object.values(extraLatLng).some((v) => {
                                            if (v.lat === destination.lat && v.lng === destination.lng) {
                                                extraStop.push({
                                                    location: v.location,
                                                    stopover: true
                                                });
                                            }
                                        });

                                        destination.lat = place.geometry.location.lat();
                                        destination.lng = place.geometry.location.lng();

                                        getDistance(directionsRenderer, map);
                                    });

                                    /* ROUND TRIP DATA */
                                    // PICKUP LOCATION
                                    const roundPickUp = new google.maps.places.Autocomplete(document.getElementById("round_arrival_airport"), {
                                        fields: ["formatted_address", "geometry", "name", "address_components"],
                                        strictBounds: false,
                                    });

                                    roundPickUp.bindTo("bounds", map);

                                    roundPickUp.addListener("place_changed", () => {
                                        const place = roundPickUp.getPlace();

                                        const components = place.address_components;
                                        components.forEach(function(item, index) {
                                            if ( item.types[0] == "locality" ) {
                                                document.getElementById("city").value = item.long_name;
                                                let selectElement = document.getElementById('round_city');

                                                [...selectElement.options].filter(function(c) {
                                                    if (c.text == item.long_name) {
                                                        document.getElementById("round_city").value = c.value;
                                                    } else {
                                                        document.getElementById("round_city").value = '24';
                                                    }
                                                });

                                                document.getElementById("hCityField").value = item.long_name;
                                            }
                                            if ( item.types[0] == "administrative_area_level_1" ) {
                                                document.getElementById("round_state").value = item.long_name;
                                            }
                                            if ( item.types[0] == "postal_code" ) {
                                                document.getElementById("round_zip").value = item.long_name;
                                            }
                                        });

                                        if (!place.geometry || !place.geometry.location) {
                                            window.alert("No details available for input: '" + place.name + "'");
                                            return;
                                        }

                                        roundPickup.lat = place.geometry.location.lat();
                                        roundPickup.lng = place.geometry.location.lng();

                                        jQuery("#round_extra_street").removeAttr("readonly");
                                        jQuery("#round_extra_street").parent().find("span").remove();

                                        jQuery("#round_street").removeAttr("readonly");
                                        jQuery("#round_street").parent().find("span").remove();
                                    });

                                    // EXTRA STOP
                                    const roundExtraStreet = new google.maps.places.Autocomplete(document.getElementById("round_extra_street"), {
                                        fields: ["formatted_address", "geometry", "name", "address_components"],
                                        strictBounds: false,
                                    });

                                    roundExtraStreet.bindTo("bounds", map);

                                    roundExtraStreet.addListener("place_changed", () => {
                                        const place = roundExtraStreet.getPlace();
                                        const components = place.address_components;
                                        components.forEach(function(item, index) {
                                            if ( item.types[0] == "locality" ) {
                                                document.getElementById("extra_city").value = item.long_name;;
                                            }
                                            if ( item.types[0] == "administrative_area_level_1" ) {
                                                document.getElementById("extra_state").value = item.long_name;
                                            }
                                            if ( item.types[0] == "postal_code" ) {
                                                document.getElementById("extra_zip").value = item.long_name;
                                            }
                                        });

                                        if (!place.geometry || !place.geometry.location) {
                                            window.alert("No details available for input: '" + place.name + "'");
                                            return;
                                        }

                                        if (roundDestination.lat == 0 && roundDestination.lng == 0) {
                                            roundDestination.lat = place.geometry.location.lat();
                                            roundDestination.lng = place.geometry.location.lng();
                                            roundExtraLatLng.push({
                                                lat: place.geometry.location.lat(),
                                                lng: place.geometry.location.lng(),
                                                location: place.formatted_address
                                            });
                                        } else {
                                            roundExtraStop.push({
                                                location: place.formatted_address,
                                                stopover: true
                                            });
                                        }

                                        getRoundDistance(directionsRendererRound, map);
                                    });

                                    // DROPOFF LOCATION
                                    const roundDropoff = new google.maps.places.Autocomplete(document.getElementById("round_street"), {
                                        fields: ["formatted_address", "geometry", "name", "address_components"],
                                        strictBounds: false,
                                    });

                                    roundDropoff.bindTo("bounds", map);

                                    roundDropoff.addListener("place_changed", () => {
                                        const place = roundDropoff.getPlace();

                                        const components = place.address_components;
                                        components.forEach(function(item, index) {
                                            if ( item.types[0] == "locality" ) {
                                                document.getElementById("hCityFielddrop").value = item.long_name;;
                                            }
                                            if ( item.types[0] == "administrative_area_level_1" ) {
                                                document.getElementById("hstate").value = item.long_name;
                                            }
                                            if ( item.types[0] == "postal_code" ) {
                                                document.getElementById("hzip").value = item.long_name;
                                            }
                                        });


                                        if (!place.geometry || !place.geometry.location) {
                                            window.alert("No details available for input: '" + place.name + "'");
                                            return;
                                        }

                                        Object.values(roundExtraLatLng).some((v) => {
                                            if (v.lat === roundDestination.lat && v.lng === roundDestination.lng) {
                                                roundExtraStop.push({
                                                    location: v.location,
                                                    stopover: true
                                                });
                                            }
                                        });

                                        roundDestination.lat = place.geometry.location.lat();
                                        roundDestination.lng = place.geometry.location.lng();

                                        getRoundDistance(directionsRendererRound, map);
                                    });
                                }

                                getDistance = (directionsRenderer, map) => {
                                    if (pickup.lat != 0 && pickup.lng && destination.lat != 0 && destination.lng != 0) {
                                        let route = {
                                            origin: pickup,
                                            destination: destination,
                                            waypoints: extraStop,
                                            travelMode: 'DRIVING'
                                        }
                                        directionsRenderer.setMap(null);
                                        console.log(route);

                                        new google.maps.DirectionsService().route(route,
                                            function(response, status) {
                                            if (status !== 'OK') {
                                                window.alert('Directions request failed due to ' + status);
                                                return;
                                            } else {
                                                directionsRenderer.setMap(map);
                                                directionsRenderer.setDirections(response);
                                                let directionsData = response.routes[0].legs[0];
                                                let dirLegs = response.routes[0].legs;
                                                let dis = 0;
                                                let dur = 0;
                                                for (let i = 0; i < dirLegs.length; i++) {
                                                    console.log(dirLegs[i]);
                                                    dis += dirLegs[i].distance.value;
                                                    dur += dirLegs[i].duration.value;
                                                }
                                                distance = dis;
                                                duration = dur;

                                                if (!directionsData) {
                                                    window.alert('Directions request failed');
                                                    return;
                                                } else {
                                                    let dis_mile = ( distance * 0.000621371192 ).toFixed(2);

                                                    let seconds = Number(duration);
                                                    let d = Math.floor(seconds / (3600*24));
                                                    let h = Math.floor(seconds % (3600*24) / 3600);
                                                    let m = Math.floor(seconds % 3600 / 60);

                                                    let dDisplay = d > 0 ? d + (d == 1 ? " day, " : " days, ") : "";
                                                    let hDisplay = h > 0 ? h + (h == 1 ? " hour, " : " hours, ") : "";
                                                    let mDisplay = m > 0 ? m + (m == 1 ? " minute" : " minutes") : "";
                                                    document.getElementById('msg').innerHTML = " Driving distance is " + dis_mile + " mi (" + dDisplay + hDisplay + mDisplay + ").";
                                                    // document.getElementById('distance_miles').value = (dis_mile.split(" mi")[0]).replace(",", "");
                                                    document.getElementById('distance_miles').value = dis_mile;
                                                    // distance = dis_mile;
                                                }
                                            }
                                        });
                                    }
                                }

                                getRoundDistance = (directionsRendererRound, map) => {
                                    if (roundPickup.lat != 0 && roundPickup.lng && roundDestination.lat != 0 && roundDestination.lng != 0) {
                                        let route = {
                                            origin: roundPickup,
                                            destination: roundDestination,
                                            waypoints: roundExtraStop,
                                            travelMode: 'DRIVING'
                                        }
                                        directionsRendererRound.setMap(null);
                                        console.log(route);

                                        new google.maps.DirectionsService().route(route,
                                            function(response, status) {
                                            if (status !== 'OK') {
                                                window.alert('Directions request failed due to ' + status);
                                                return;
                                            } else {
                                                directionsRendererRound.setMap(map);
                                                directionsRendererRound.setDirections(response);
                                                let directionsData = response.routes[0].legs[0];
                                                let dirLegs = response.routes[0].legs;
                                                let dis = 0;
                                                let dur = 0;
                                                for (let i = 0; i < dirLegs.length; i++) {
                                                    console.log(dirLegs[i]);
                                                    dis += dirLegs[i].distance.value;
                                                    dur += dirLegs[i].duration.value;
                                                }
                                                if (!directionsData) {
                                                    window.alert('Directions request failed');
                                                    return;
                                                } else {
                                                    let dis_mile = ( ( distance + dis ) * 0.000621371192 ).toFixed(2);

                                                    let seconds = Number(duration + dur);
                                                    let d = Math.floor(seconds / (3600*24));
                                                    let h = Math.floor(seconds % (3600*24) / 3600);
                                                    let m = Math.floor(seconds % 3600 / 60);

                                                    let dDisplay = d > 0 ? d + (d == 1 ? " day, " : " days, ") : "";
                                                    let hDisplay = h > 0 ? h + (h == 1 ? " hour, " : " hours, ") : "";
                                                    let mDisplay = m > 0 ? m + (m == 1 ? " minute" : " minutes") : "";
                                                    document.getElementById('msg').innerHTML = " Driving distance is " + dis_mile + " mi (" + dDisplay + hDisplay + mDisplay + ").";
                                                    // document.getElementById('distance_miles').value = (dis_mile.split(" mi")[0]).replace(",", "");
                                                    document.getElementById('round_distance_miles').value = ( dis * 0.000621371192 ).toFixed(2);;
                                                    // distance = dis_mile;
                                                }
                                            }
                                        });
                                    }
                                }
                            </script>
                            <img style="display: none;" src="images/staticmap.png" class="map-img"/>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="distance" id="distance_miles" value="0" />
                <input type="hidden" name="round_distance" id="round_distance_miles" value="0" />

                <div class="veh-btns-wrapper mb-3" style="display: none;">
                    <div class="new-res-wrap me-2">
                        <a href="javascript:void(0);" class="buttons startNew ">Edit Info</a>
                    </div>

                    <div class="change-veh-wrap me-2" <?= (isset($_REQUEST['sendReq']) ? 'style="display: block;"' : 'style="display:none;"'); ?>>
                        <a href="javascript:void(0);" class="buttons Changevehicle ">Change vehicle</a>
                    </div>
                </div>

                <div class="filtered-vehicles-list-wrapper step-2" style="display: none;">

                    <div class="left-area-wrapper">
                        <h3>Select a vehicle below to book your reservation</h3>
                        <div id="vhehRates"></div>
                    </div>

                    <div class="right-area-wrapper">
                        <div class="highlight-box">

                            <div class="">
                                <h3>Request Summary </h3>
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Service</th>
                                            <td class="serviceType">To Airport</td>
                                        </tr>
                                        <tr>
                                            <th>Passengers</th>
                                            <td class="passengers">1</td>
                                        </tr>
                                    </thead>
                                </table>
                                <h3 class="section-title">Trip information</h3>
                                <table class="table table-condensed">
                                    <tbody>
                                        <tr>
                                            <th>Pickup time</th>
                                            <td class="pickupdatetime">Fri Feb 15, 2019 12:30 AM</td>
                                        </tr>
                                        <tr>
                                            <th>Pickup Location</th>
                                            <td class="pickuplocation">Gold Street, NY, 11201</td>
                                        </tr>
                                        <tr class="extrastoplocation_row">
                                            <th>Extra Stop Location</th>
                                            <td class="extrastoplocation">Gold Street, NY, 11201</td>
                                        </tr>
                                        <tr ng-show="order_dropoff" class="">
                                            <th>Dropoff Location</th>
                                            <td class="dropofflocation">John F. Kennedy International Airport</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="roundTripInfo" style="display: none;">
                                    <h3 class="section-title">Return Trip Information</h3>
                                    <table class="table table-condensed">
                                        <tbody>
                                            <tr>
                                                <th>Pickup time</th>
                                                <td class="roundpickupdatetime">Fri Feb 15, 2019 12:30 AM</td>
                                            </tr>
                                            <tr>
                                                <th>Pickup Location</th>
                                                <td class="roundpickuplocation">Gold Street, NY, 11201</td>
                                            </tr>
                                            <tr class="round_extrastoplocation_row">
                                                    <th>Extra Stop Location</th>
                                                    <td class="round_extrastoplocation">Gold Street, NY, 11201</td>
                                            </tr>
                                            
                                            <tr class="">
                                                <th>Dropoff Location</th>
                                                <td class="rounddropofflocation">John F. Kennedy International Airport</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="personal-info-wrapper step-3" style="display:none;">
                    <div class="left-area-wrapper">
                        <input type="hidden" name="vehName" class="veh_name_input" value="<?= rs(post('vehName')) ?>"/>
                        <input type="hidden" name="vehId" class="veh_id_input" value="<?= rs(post('vehId')) ?>"/>
                        <input type="hidden" name="vehprice" class="vehprice" value=""/>

                        <h3>Selected vehicle is (<span class="veh_name"><?= rs(post('vehName')) ?></span>)</h3>

                        <div class="element_wrapper">
                            <div class="label_wrapper">
                                First Name: *
                            </div>
                            <div class="input_wrapper">
                                <input type="text" id="firstname_pay" value="<?= rs(post('name')) ?>" name="name" size="20" class="formbox">
                            </div>
                        </div>
                        <div class="element_wrapper">
                            <div class="label_wrapper">
                                Last Name: * 
                            </div>
                            <div class="input_wrapper">
                                <input type="text" id="lastname_pay" value="<?= rs(post('lastname')) ?>" name="lastname" size="20" class="formbox">
                            </div>
                        </div>

                        <div class="element_wrapper">
                            <div class="label_wrapper">
                                Phone Number:
                            </div>
                            <div class="input_wrapper">
                                <input type="text" value="<?= rs(post('phone')) ?>" name="phone" maxlength="25" size="20" class="formbox">
                            </div>
                        </div>

                        <div class="element_wrapper">
                            <div class="label_wrapper">
                                Cell Phone:
                            </div>
                            <div class="input_wrapper">
                                <input type="text" value="" name="cellphone" maxlength="25" size="20" class="formbox">
                            </div>
                        </div>
                        <div class="element_wrapper">
                            <div class="label_wrapper">
                                E-mail: *
                            </div>
                            <div class="input_wrapper">
                                <input type="email" value="<?= rs(post('email')) ?>" name="email" class="uemail" size="20" class="formbox">
                            </div>
                        </div>
                        <div class="element_wrapper">
                            <div class="label_wrapper">
                                Airline:
                            </div>
                            <div class="input_wrapper">
                                <select name="departure_airline" size="1" class="formbox">
                                    <option value="Select Airline">Select Airline</option>
                                    <option value="Air Canada">Air Canada</option>
                                    <option value="Air France">Air France</option>
                                    <option value="Alitalia">Alitalia</option>
                                    <option value="American Airlines">American Airlines</option>
                                    <option value="British Airways">British Airways</option>
                                    <option value="Continental">Continental</option>
                                    <option value="Delta">Delta</option>
                                    <option value="Jet Blue">Jet Blue</option>
                                    <option value="Lufthansa">Lufthansa</option>
                                    <option value="Midway">Midway</option>
                                    <option value="Northwest">Northwest</option>
                                    <option value="Southwest">Southwest</option>
                                    <option value="United">United</option>
                                    <option value="US Airways">US Airways</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="element_wrapper">
                            <div class="label_wrapper">
                                Flight #:
                            </div>
                            <div class="input_wrapper">
                                <input type="text" name="flight_no" class="formbox">
                            </div>
                        </div>
                        <div class="element_wrapper" style="display: none;">
                            <div class="label_wrapper">
                                Return Airline:
                            </div>
                            <div class="input_wrapper">
                                <select name="round_arrival_airline" size="1" class="formbox">
                                    <option value="Select Airline">Select Airline</option>
                                    <option value="Air Canada">Air Canada</option>
                                    <option value="Air France">Air France</option>
                                    <option value="Alitalia">Alitalia</option>
                                    <option value="American Airlines">American Airlines</option>
                                    <option value="British Airways">British Airways</option>
                                    <option value="Continental">Continental</option>
                                    <option value="Delta">Delta</option>
                                    <option value="Jet Blue">Jet Blue</option>
                                    <option value="Lufthansa">Lufthansa</option>
                                    <option value="Midway">Midway</option>
                                    <option value="Northwest">Northwest</option>
                                    <option value="Southwest">Southwest</option>
                                    <option value="United">United</option>
                                    <option value="US Airways">US Airways</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="element_wrapper" style="display: none;">
                            <div class="label_wrapper">
                                Return Flight #:
                            </div>
                            <div class="input_wrapper">
                                <input type="text" name="round_arrival_flight_no" class="formbox">
                            </div>
                        </div>
                        <div class="element_wrapper">
                            <div class="label_wrapper hdesc">
                                Passenger info if different:
                            </div>
                            <div class="input_wrapper">
                                <textarea rows="3" class="uemail" name="passengerInfo"></textarea>
                            </div>
                        </div>

                        <div class="element_wrapper">
                            <div class="label_wrapper">
                                Driver Note:
                            </div>
                            <div class="input_wrapper">
                                <textarea rows="3" class="driverNote" name="driverNote"></textarea>
                            </div>
                        </div>

                        <div class="step-5 additional-pricing" style="width: 100%;clear: both;overflow: hidden;margin: 10px 0px 0px;border-radius: 3px;">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th width="25"></th>
                                        <th style="width:140px;">Services</th>
                                        <th class="text-right">Prices</th>
                                    </tr>
                                </thead>

                                <?php
                                $result = $db->getAll("select * from " . DB_TABLE_PREFIX . "res_pricing order by pricing_name asc ");
                                foreach ($result as $key => $row) {
                                    $pricing_type = $row['pricing_type'];
                                    $pricing_price = $row['pricing_price'];
                                    if($pricing_type == 1) $sym = $pricing_price . "%";
                                    else $sym = "$" . $pricing_price;
                                    ?>
                                    <tr class="res_pricing">
                                        <td width="25">
                                            <input type="checkbox" class='additionalf' name="additional['<?= $row['pricing_id']; ?>']" value="<?= $row['pricing_price']; ?>" id="additional_<?=$row['pricing_id']?>" onClick="calculatePrice(this);"  <?= ($row['pricing_id'] == '12' ? 'checked=checked' : ''); ?>/>
                                        </td>
                                        <td><?=  $row['pricing_name']; ?></td>
                                        <td class="additionalPrice text-right">
                                            <?= $sym ; ?> 
                                            <input type="hidden" class="additionalPrice additionalf<?= $row['pricing_id']; ?>" name="additionalPrice['<?= $row['pricing_id']; ?>']" value="<?= $row['pricing_price']; ?>" />
                                        </td>
                                    </tr>
                                <?php } ?>

                                <tfoot>

                                    <tr class="res_pricing">
                                        <th width="25">Additional Charges</th>
                                        <th><input type="text" class="CustomAdditionalCharges" name="CustomAdditionalCharges" value="0"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" /></th>
                                        <th class="CustomAdditionalChargesWrap text-right">
                                            $<span id="CustomAdditionalCharges">0.00</span>
                                        </th>
                                    </tr>

                                    <tr class="res_pricing">
                                        <th width="25"></th>
                                        <th>Gratuity</th>
                                        <th class="gratuityChargesWrap text-right">
                                            $<span id="gratuityCharges">0</span>
                                            <input type="hidden" class="gratuityCharges" name="gratuityCharges" value="0" />
                                        </th>
                                    </tr>

                                    <tr class="res_pricing">
                                        <th width="25"></th>
                                        <th>Additional Service Charges Total</th>
                                        <th class="resPrice text-right">
                                            $<span id="AdditionalServiceChargesTotal">0</span>.00
                                            <input type="hidden" class="AdditionalServiceChargesTotal" name="AdditionalServiceChargesTotal" value="0" />
                                        </th>
                                    </tr>

                                    <tr>
                                        <th width="25"></th>
                                        <th>Total Reservation Price</th>
                                        <th class="resPrice text-right">
                                            $<span class="resPricetotal">0</span>
                                            <input type="hidden" class="resPricetotal" id="resPricetotal" name="resPricetotal" value="0" />
                                        </th>
                                    </tr>

                                    <tr>
                                        <th width="25">Apply Discount</th>
                                        <th>
                                            <div class="discountmainwrapper">
                                                <div id="DisMsg"></div>
                                                <div class="coupon" id="couponerrors"></div>
                                                <input type="text" class="discountCoupon" name="discountCoupon" value="" style=" width: 110px; "/>
                                                <input type="hidden" class="discountPrice" name="discountPrice" value="" />
                                                <input type="button" value="Apply" name="discountReq" id="discountReq" class="buttons">
                                            </div>
                                        </th>
                                        <th class="discountC text-right">
                                            $<span class="discountPrice">0.00</span>
                                        </th>
                                    </tr>

                                    <tr>
                                        <th width="25"></th>
                                        <th>Total Cost Of Reservation</th>
                                        <th class="resPrice text-right">
                                            $<span id="actualtotal" class="actualtotal">0</span>.00
                                            <input type="hidden" class="actualtotal" id="actualtotalinput" name="actualtotal" value="0" />
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="form_footer form_action">
                            <input type="button" value="Pay Now" name="sendReq" id="sendReqNow" class="formbutton buttons" />
                        </div>

                    </div>

                    <div class="right-area-wrapper">
                        <div class="highlight-box">

                            <div class="">
                                <h3>Request Summary </h3>
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Service</th>
                                            <td class="serviceType">To Airport</td>
                                        </tr>
                                        <tr>
                                            <th>Passengers</th>
                                            <td class="passengers">1</td>
                                        </tr>
                                        <tr>
                                            <th>Tax</th>
                                            <td class="reservationTax">0</td>
                                        </tr>
                                    </thead>
                                </table>
                                <h3 class="section-title">Trip information</h3>
                                <table class="table table-condensed">
                                    <tbody>
                                        <tr>
                                            <th>Pickup time</th>
                                            <td class="pickupdatetime">Fri Feb 15, 2019 12:30 AM</td>
                                        </tr>
                                        <tr>
                                            <th>Pickup Location</th>
                                            <td class="pickuplocation">Gold Street, NY, 11201</td>
                                        </tr>
                                        <tr class="extrastoplocation_row">
                                            <th>Extra Stop Location</th>
                                            <td class="extrastoplocation">Gold Street, NY, 11201</td>
                                        </tr>
                                        <tr ng-show="order_dropoff" class="">
                                            <th>Dropoff Location</th>
                                            <td class="dropofflocation">John F. Kennedy International Airport</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="roundTripInfo" style="display: none;">
                                    <h3 class="section-title">Return Trip Information</h3>
                                    <table class="table table-condensed">
                                        <tbody>
                                            <tr>
                                                <th>Pickup time</th>
                                                <td class="roundpickupdatetime">Fri Feb 15, 2019 12:30 AM</td>
                                            </tr>
                                            <tr>
                                                <th>Pickup Location</th>
                                                <td class="roundpickuplocation">Gold Street, NY, 11201</td>
                                            </tr>
                                            <tr class="extrastoplocation_row">
                                                <th>Extra Stop Location</th>
                                                <td class="extrastoplocation">Gold Street, NY, 11201</td>
                                            </tr>
                                            <tr class="">
                                                <th>Dropoff Location</th>
                                                <td class="rounddropofflocation">John F. Kennedy International Airport</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </form>

            <div class="step-4 payment" style="display: none;">
                <div class="left-area-wrapper">

                    <div class="highlight-box">

                        <div class="">
                            <h3>Request Summary </h3>
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th>Service</th>
                                        <td class="serviceType">To Airport</td>
                                    </tr>
                                    <tr>
                                        <th>Passengers</th>
                                        <td class="passengers">1</td>
                                    </tr>
                                </thead>
                            </table>
                            <h3 class="section-title">Trip information</h3>
                            <table class="table table-condensed">
                                <tbody>
                                    <tr>
                                        <th>Pickup time</th>
                                        <td class="pickupdatetime">Fri Feb 15, 2019 12:30 AM</td>
                                    </tr>
                                    <tr>
                                        <th>Pickup Location</th>
                                        <td class="pickuplocation">Gold Street, NY, 11201</td>
                                    </tr>
                                    <tr class="extrastoplocation_row">
                                        <th>Extra Stop Location</th>
                                        <td class="extrastoplocation">Gold Street, NY, 11201</td>
                                    </tr>
                                    <tr ng-show="order_dropoff" class="">
                                        <th>Dropoff Location</th>
                                        <td class="dropofflocation">John F. Kennedy International Airport</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="roundTripInfo" style="display: none;">
                                <h3 class="section-title">Return Trip Information</h3>
                                <table class="table table-condensed">
                                    <tbody>
                                        <tr>
                                            <th>Pickup time</th>
                                            <td class="roundpickupdatetime">Fri Feb 15, 2019 12:30 AM</td>
                                        </tr>
                                        <tr>
                                            <th>Pickup Location</th>
                                            <td class="roundpickuplocation">Gold Street, NY, 11201</td>
                                        </tr>
                                        <tr class="extrastoplocation_row">
                                            <th>Extra Stop Location</th>
                                            <td class="extrastoplocation">Gold Street, NY, 11201</td>
                                        </tr>
                                        <tr class="">
                                            <th>Dropoff Location</th>
                                            <td class="rounddropofflocation">John F. Kennedy International Airport</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <script src="https://js.stripe.com/v3/"></script>
                    <style>
                        .my-input {
                            padding: 10px;
                            border: 1px solid #ccc;
                        }
                    </style>
                    <form action="stripePayment.php" method="post" id="payment-form">
                        <div class="form-row">
                            <input type="hidden" name="price" value="" />
                            <input type="hidden" name="stripeEmail" value="" />
                            <input type="hidden" name="paymentMethod" value="" />
                            <label for="card-element">&nbsp;</label>
                            <div id="card-element" class="my-input"></div>

                            <div id="card-errors" role="alert" style="color:red;margin-top:10px;"></div>
                        </div>
                        <br />
                        <button class="formbutton buttons" type="button" id="card-button">Submit Payment</button>
                    </form>

                    <script type="text/javascript">
                        const stripe = Stripe("");
                        
                        const elements = stripe.elements();

                        const style = {
                            base: {
                                fontSize: '16px',
                                color: '#32325d',
                            },
                        };
                        const card = elements.create('card', {style});
                        card.mount('#card-element');

                        const cardButton = document.getElementById('card-button');

                        cardButton.addEventListener('click', async (event) => {
                            event.preventDefault();

                            const firstname = document.getElementById("firstname_pay").value;
                            const lastname = document.getElementById("lastname_pay").value;

                            const {paymentMethod, error} = await stripe.createPaymentMethod({
                                type: 'card',
                                card: card,
                                billing_details: {
                                    name: firstname + " " + lastname,
                                },
                            });

                            if (error) {
                                // Display error.message in your UI.
                                console.log(error);
                                jQuery('#card-errors').text(error.message);
                            } else {
                                console.log(paymentMethod);
                                jQuery('#payment-form input[name=paymentMethod]').val(paymentMethod.id);
                                jQuery('#payment-form input[name=price]').val(jQuery('#actualtotalinput').val());
                                jQuery('#payment-form input[name=stripeEmail]').val(jQuery('.uemail').val());
                                jQuery('#payment-form').submit();
                            }
                        });
                    </script>
                    <div class="responceData" style=" margin: 15px 0px 0; "></div>
                </div>
            </div>
        </div>
    </div>

    <div class="section our-services">
        <div class="container">
            <div class="row">
                <?php echo $service_text; ?>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        addExtraStop = (e) => {
            let extraLength = jQuery(e).parent().find(".extra_street").length;
            jQuery('<input type="text" id="extra_street'+extraLength+'" name="extra_street" size="20" class="formbox extra_street" >').insertBefore(jQuery(e));

            const extraStreet = new google.maps.places.Autocomplete(document.getElementById("extra_street"+extraLength), {
                fields: ["formatted_address", "geometry", "name", "address_components"],
                strictBounds: false,
            });

            extraStreet.bindTo("bounds", map);

            extraStreet.addListener("place_changed", () => {
                const place = extraStreet.getPlace();
                const components = place.address_components;
                components.forEach(function(item, index) {
                    if ( item.types[0] == "locality" ) {
                        document.getElementById("extra_city").value = item.long_name;;
                    }
                    if ( item.types[0] == "administrative_area_level_1" ) {
                        document.getElementById("extra_state").value = item.long_name;
                    }
                    if ( item.types[0] == "postal_code" ) {
                        document.getElementById("extra_zip").value = item.long_name;
                    }
                });

                if (!place.geometry || !place.geometry.location) {
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }

                if (destination.lat == 0 && destination.lng == 0) {
                    destination.lat = place.geometry.location.lat();
                    destination.lng = place.geometry.location.lng();
                    extraLatLng.push({
                        lat: place.geometry.location.lat(),
                        lng: place.geometry.location.lng(),
                        location: place.formatted_address
                    });
                } else {
                    extraStop.push({
                        location: place.formatted_address,
                        stopover: true
                    });
                }

                getDistance(directionsRenderer, map);
            });
        }

        addExtraRoundStop = (e) => {
            let extraLength = jQuery(e).parent().find(".round_extra_street").length;
            jQuery('<input type="text" id="round_extra_street'+extraLength+'" name="round_extra_street" size="20" class="formbox extra_street" >').insertBefore(jQuery(e));

            const extraStreet = new google.maps.places.Autocomplete(document.getElementById("round_extra_street"+extraLength), {
                fields: ["formatted_address", "geometry", "name", "address_components"],
                strictBounds: false,
            });

            extraStreet.bindTo("bounds", map);

            extraStreet.addListener("place_changed", () => {
                const place = extraStreet.getPlace();
                const components = place.address_components;
                components.forEach(function(item, index) {
                    if ( item.types[0] == "locality" ) {
                        document.getElementById("extra_city").value = item.long_name;;
                    }
                    if ( item.types[0] == "administrative_area_level_1" ) {
                        document.getElementById("extra_state").value = item.long_name;
                    }
                    if ( item.types[0] == "postal_code" ) {
                        document.getElementById("extra_zip").value = item.long_name;
                    }
                });

                if (!place.geometry || !place.geometry.location) {
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }

                if (roundDestination.lat == 0 && roundDestination.lng == 0) {
                    roundDestination.lat = place.geometry.location.lat();
                    roundDestination.lng = place.geometry.location.lng();
                    roundExtraLatLng.push({
                        lat: place.geometry.location.lat(),
                        lng: place.geometry.location.lng(),
                        location: place.formatted_address
                    });
                } else {
                    roundExtraStop.push({
                        location: place.formatted_address,
                        stopover: true
                    });
                }

                getRoundDistance(directionsRendererRound, map);
            });
        }

        jQuery("#discountReq").click(function () {
            jQuery('#DisMsg').html('');
            var discountCoupon = jQuery('.discountCoupon').val();
            var actualtotal = jQuery('#actualtotalinput').val();

            jQuery.ajax({
                type: "POST",
                url: "getDiscountInfo.php",
                data: {
                    'coupon_code': discountCoupon,
                    'estimated_total': actualtotal
                },
                cache: false,
                dataType: "json",
                success: function (data) {
                    jQuery.each(data, function (index, element) {
                        if (index == 'error') {
                            jQuery('#couponerrors').html(element);

                            jQuery('html, body').animate({
                                scrollTop: jQuery("#couponerrors").offset().top
                            }, 1000);
                            jQuery('.discountPrice').html(0);
                            jQuery('.discountPrice').val(0);
                            calculatePrice('nothing');
                        }

                        if (index == 'price') {
                            jQuery('.actualtotal').html(element);
                            jQuery('.actualtotal').val(element);
                        }

                        if (index == 'coupon_price') {
                            jQuery('.discountPrice').html(element);
                            jQuery('.discountPrice').val(element);

                            jQuery('.discountmainwrapper').hide();

                        }

                    });
                },
                error: function (e) {
                    jQuery('.discountPrice').html(0);
                    jQuery('.discountPrice').val(0);
                    calculatePrice('nothing');
                    var err = eval("(" + e.responseText + ")");
                    jQuery("#DisMsg").append("<tr class=whtebg><td colspan=7><div class='alert alert-danger'><u>Opps!</u>: " + err.message + "</div></td></tr>");
                }
            });
        });

        jQuery(".CustomAdditionalCharges").change(function () {
            var CustomAdditionalCharges = this.value;

            if (CustomAdditionalCharges == '') {
                CustomAdditionalCharges = 0;
            }
            jQuery("#CustomAdditionalCharges").html(CustomAdditionalCharges);

            var gratuityCharges = jQuery('.gratuityCharges').val();
            var AdditionalServiceChargesTotal = jQuery('.AdditionalServiceChargesTotal').val();
            var resPricetotal = jQuery('#resPricetotal').val();
            var actualtotal = parseInt(gratuityCharges) + parseInt(AdditionalServiceChargesTotal) + parseInt(resPricetotal) + parseInt(CustomAdditionalCharges);
            jQuery('.actualtotal').val(actualtotal);
            jQuery('#actualtotal').html(actualtotal);
        });

        var totalp = 0;
        var taxvar = 0;
        function calculatePrice(item) {
            var totalp = 0;
            
            jQuery('input:checkbox.additionalf').each(function () {
                var sThisVal = (this.checked ? jQuery(this).val() : 0);
                var idThisVal = (this.checked ? jQuery(this).attr("id") : '');
                console.log(idThisVal);
                if(sThisVal != 6.35)	{
                    console.log("first condition", jQuery("#desire_location").val() == 3);
                    console.log("second condition + " + idThisVal, idThisVal == 'additional_11');
                    console.log("main condition", (jQuery("#desire_location").val() == 3 && idThisVal == 'additional_11'));
                    if (jQuery("#desire_location").val() == 3 && idThisVal == 'additional_11') {
                        totalp += (parseInt(sThisVal)*2);
                    } else {
                        totalp += parseInt(sThisVal);
                    }
                    // console.log('new total: ' + totalp);
                }else if(sThisVal == 6.35){
                    taxvar = 1;
                }
            });

            if (item != 'nothing') {
                jQuery('.AdditionalServiceChargesTotal').val(totalp);
                jQuery('#AdditionalServiceChargesTotal').html(totalp);
            }



            var AdditionalServiceChargesTotal = jQuery('.AdditionalServiceChargesTotal').val();

            if (AdditionalServiceChargesTotal == 'NAN') {
                AdditionalServiceChargesTotal = 0;
            }

            var resp = jQuery('.resPricetotal').val();

            if (resp == '') {
                resp = 0;
            }
            var gratuityCharges = jQuery('.gratuityCharges').val();
            var CustomAdditionalCharges = jQuery('.CustomAdditionalCharges').val();

            var discountPrice = jQuery('.discountPrice').val();

            if (discountPrice == 'NAN' || discountPrice == '') {
                discountPrice = 0;
            }
            
            console.log("sel val: " + parseInt(AdditionalServiceChargesTotal));


            var actualtotal = parseInt(AdditionalServiceChargesTotal) + parseInt(resp) + parseInt(gratuityCharges) + parseInt(CustomAdditionalCharges) - parseInt(discountPrice);
            
            console.log("tax var: " + taxvar);
            if(taxvar ==1 ){//apply tax on overall total
                if(document.getElementById('additional_14').checked){
                    apply_tax = document.getElementById('additional_14').value;
                    res_tax = ((actualtotal * apply_tax) / 100);
                    
                    res_tax = res_tax.toFixed(2);
                    console.log("Res Tax after round" + res_tax);

                    actualtotal = actualtotal - (res_tax * -1);
                    
                    console.log("Res Tax" + res_tax + " and actual total: " + actualtotal);
                    jQuery('.reservationTax').html("$" + res_tax);
                }else{
                        jQuery('.reservationTax').html(0);
                }
            }
            console.log("total is" + actualtotal);

            jQuery('.actualtotal').val(actualtotal);
            jQuery('#actualtotal').html(actualtotal);
        }

        jQuery(document).ready(function () {
            jQuery("#extra_street").on("click", function() {
                if ( jQuery("#street").val() != "") {
                    jQuery("#extra_street").removeAttr("readonly");
                    jQuery("#extra_street").parent().find("span").remove();
                } else {
                    jQuery('<span class="error error_extra">Please select Pick Up Address.</span>').insertAfter("#extra_street");
                }
            });

            jQuery("#hstreet").on("click", function() {
                if ( jQuery("#street").val() != "") {
                    jQuery("#hstreet").removeAttr("readonly");
                    jQuery("#hstreet").parent().find("span").remove();
                } else {
                    jQuery('<span class="error error_extra">Please select Pick Up Address.</span>').insertAfter("#hstreet");
                }
            });

            jQuery("#dstreet").on("click", function() {
                if ( jQuery("#street").val() != "") {
                    jQuery("#dstreet").removeAttr("readonly");
                    jQuery("#dstreet").parent().find("span").remove();
                } else {
                    jQuery('<span class="error error_extra">Please select Pick Up Address.</span>').insertAfter("#dstreet");
                }
            });

            jQuery("#round_extra_street").on("click", function() {
                if ( jQuery("#round_arrival_airport").val() != "") {
                    jQuery("#round_extra_street").removeAttr("readonly");
                    jQuery("#round_extra_street").parent().find("span").remove();
                } else {
                    jQuery('<span class="error error_extra">Please select Pick Up Address.</span>').insertAfter("#round_extra_street");
                }
            });

            jQuery("#round_street").on("click", function() {
                if ( jQuery("#round_arrival_airport").val() != "") {
                    jQuery("#round_street").removeAttr("readonly");
                    jQuery("#round_street").parent().find("span").remove();
                } else {
                    jQuery('<span class="error error_extra">Please select Pick Up Address.</span>').insertAfter("#round_street");
                }
            });
        });

        jQuery("#sendReqNow").click(function (e) {
            jQuery("html, body").animate({ scrollTop: 0 }, "slow");
            jQuery('#payment-form .buttons').text("Pay $" + jQuery('#actualtotalinput').val() + " to confirm");

            jQuerybookingType = jQuery('#desire_location').val();
            console.log(jQuerybookingType);
            if (jQuerybookingType != 4) {
                var resPricetotal = jQuery('#actualtotalinput').val();
                var uemail = jQuery('.uemail').val();
                jQuery('.stripe-button').attr("data-email", uemail);
                jQuery('.stripe-button').attr("data-amount", resPricetotal);
                jQuery('.stripe-button').attr("data-label", "Pay $" + resPricetotal + " to confirm");
                jQuery('.price').val(resPricetotal);
                jQuery('.stripe-button-el span').html("Pay $" + resPricetotal + " to confirm");

                jQuery('.payment .responceData').html('');
                jQuery.ajax({
                    type: "POST",
                    url: "getRates.php?sendReq=1",
                    data: jQuery('form').serialize(),
                    cache: false,
                    dataType: "json",
                    success: function (data) {
                        jQuery.each(data, function (index, element) {
                            if (index == 'error') {
                                jQuery('.errors').html(element);

                                jQuery('html, body').animate({
                                    scrollTop: jQuery("#errors").offset().top
                                }, 1000);
                            }

                            if (index == 'payment') {
                                jQuery('.errors').html('');

                                jQuery('.step-1').hide();
                                jQuery('.step-2').hide();
                                jQuery('.step-3').hide();
                                // jQuery('.veh-btns-wrapper').hide();
                                jQuery('.payment').show();
                                jQuery('.payment .responceData').html(element);
                                jQuery('.tabed-style li').removeClass('active');
                                jQuery('.tabed-style li.s3').addClass('active');
                            }

                            if (index != 'error' && index != 'payment') {
                                jQuery('.step-1').hide();
                                jQuery('.step-2').show();
                                jQuery('.veh-btns-wrapper').show();
                                jQuery('.new-res-wrap').show();
                                jQuery('#vhehRates').append(element);
                            }

                        });
                    },
                    error: function (e) {
                        var err = eval("(" + e.responseText + ")");
                        jQuery('.errors').html(err.message);
                    }
                });
            } else if (jQuerybookingType == 4) {
                var resPricetotal = jQuery('#actualtotalinput').val();
                var uemail = jQuery('.uemail').val();
                jQuery('.stripe-button').attr("data-email", uemail);
                jQuery('.stripe-button').attr("data-amount", resPricetotal);
                jQuery('.stripe-button').attr("data-label", "Pay $" + resPricetotal + " to confirm");
                jQuery('.price').val(resPricetotal);
                jQuery('.stripe-button-el span').html("Pay $" + resPricetotal + " to confirm");

                jQuery('.payment .responceData').html('');
                jQuery.ajax({
                    type: "POST",
                    url: "getCars.php?sendReq=1",
                    data: jQuery('form').serialize(),
                    cache: false,
                    dataType: "json",
                    success: function (data) {
                        jQuery.each(data, function (index, element) {

                            if (index == 'total') {
                                jQuery('.actualtotal').val(element);
                                jQuery('.actualtotal').html(element);
                            }
                            if (index == 'error') {
                                jQuery('.errors').html(element);

                                jQuery('html, body').animate({
                                    scrollTop: jQuery("#errors").offset().top
                                }, 1000);
                            }

                            if (index == 'payment') {
                                jQuery('.errors').html('');

                                jQuery('.step-1').hide();
                                jQuery('.step-2').hide();
                                jQuery('.step-3').hide();
                                // jQuery('.veh-btns-wrapper').hide();
                                jQuery('.payment').show();
                                jQuery('.payment .responceData').html(element);
                                jQuery('.tabed-style li').removeClass('active');
                                jQuery('.tabed-style li.s3').addClass('active');
                            }

                            if (index != 'error' && index != 'payment') {
                                jQuery('.step-1').hide();
                                jQuery('.step-2').show();
                                jQuery('.veh-btns-wrapper').show();
                                jQuery('.new-res-wrap').show();
                                jQuery('#vhehRates').append(element);
                            }

                        });
                    },
                    error: function (e) {
                        var err = eval("(" + e.responseText + ")");
                        jQuery('.errors').html(err.message);
                    }
                });
            }
            return false;
        });

        jQuery(".getPrice").click(function (e) {
            var desire_location = jQuery('#desire_location option:selected').html();
            var desire_location_id = jQuery('#desire_location').val();

            var passengers = jQuery('#passengers').val();
            var shours = jQuery('#shours').val();
            var departure_date = jQuery('#departure_date').val();
            var ddParts = departure_date.split("-");
            console.log(departure_date);
            console.log(ddParts);
            departure_date = ddParts[1] + "-" + ddParts[2] + "-" + ddParts[0];
            console.log(departure_date);
            var actual_pick_up_time = jQuery('#actual_pick_up_time').val();

            var street = jQuery('#street').val();
            var city = jQuery('#city option:selected').html();
            var state = jQuery('#state option:selected').html();
            var zip = jQuery('#zip').val();
            var arrival_airport = jQuery('#arrival_airport option:selected').html();

            // Round Trip values
            var round_departure_date = jQuery('#round_departure_date').val();
            var rddParts = round_departure_date.split("-");
            console.log(round_departure_date);
            console.log(rddParts);
            round_departure_date = rddParts[1] + "-" + rddParts[2] + "-" + rddParts[0];
            console.log(round_departure_date);
            var round_actual_pick_up_time = jQuery('#round_actual_pick_up_time').val();

            var round_street = jQuery('#round_street').val();
            var round_city = jQuery('#round_city option:selected').html();
            var round_state = jQuery('#round_state option:selected').html();
            var round_zip = jQuery('#round_zip').val();
            var round_arrival_airport = jQuery('#round_arrival_airport option:selected').html();


            jQuery('.serviceType').html(desire_location);
            jQuery('.passengers').html(passengers);

            jQuery('.pickupdatetime').html(departure_date + ', ' + actual_pick_up_time);
            
            //get the information of extra stop					
            jQuery('.extrastoplocation_row').show();
            let extraStreets = jQuery('.extra_street');
            let extraStrArray = [];
            for (let i = 0; i < extraStreets.length; i++) {
                if (extraStreets[i] != undefined) {
                    extraStrArray.push(jQuery(extraStreets[i]).val());
                }
            }
            var extra_street = extraStrArray.join(" | ");

            var extra_city = jQuery('#extra_city').val();
            var extra_state = jQuery('#extra_state option:selected').html();
            var extra_zip = jQuery('#extra_zip').val();
            var extra_stop = extra_street + extra_city + extra_state + extra_zip;
            
            jQuery('.extrastoplocation').html(extra_street);				
            
            if(extra_stop != "Please Select ..." && desire_location_id != 4){
                if(document.getElementById('additional_9').checked == false){
                    jQuery('#additional_9').attr('checked', true);
                }

            }else{
                if(document.getElementById('additional_9').checked == true){
                    jQuery('#additional_9').attr('checked', false);
                }
            }

            if (desire_location_id == 1) {
                jQuery('.roundTripInfo').hide();

                jQuery('.pickuplocation').html(street);
                jQuery('.dropofflocation').html(jQuery('#hstreet').val());
            } else if (desire_location_id == 2) {
                jQuery('.roundTripInfo').hide();

                jQuery('.dropofflocation').html(jQuery('#hstreet').val());
                jQuery('.pickuplocation').html(street);
            } else if (desire_location_id == 3) {
                jQuery('.roundTripInfo').show();
                jQuery('.pickuplocation').html(street);
                jQuery('.dropofflocation').html(jQuery('#hstreet').val());

                jQuery('.roundpickupdatetime').html(round_departure_date + ', ' + round_actual_pick_up_time);
                jQuery('.rounddropofflocation').html(round_street);
                jQuery('.roundpickuplocation').html(jQuery("#round_arrival_airport").val());
                
                jQuery('.round_extrastoplocation_row').show();
                var round_extra_street = jQuery('#round_extra_street').val();
                var round_extra_city = jQuery('#round_extra_city').val();
                var round_extra_state = jQuery('#round_extra_state option:selected').html();
                var round_extra_zip = jQuery('#round_extra_zip').val();
                var round_extra_stop = round_extra_street + round_extra_city + round_extra_state + round_extra_zip
                
                jQuery('.round_extrastoplocation').html(round_extra_street);
                                    
                if(round_extra_stop != "Please Select ..."){// for round extra stop
                    if(document.getElementById('additional_18').checked == false){
                        jQuery('#additional_18').attr('checked', true);
                        //calculatePrice(document.getElementById('additional_9'));
                    }

                }else{
                    if(document.getElementById('additional_18').checked == true){
                        jQuery('#additional_18').attr('checked', false);
                        //calculatePrice(document.getElementById('additional_9'));
                    }
                }
                
            } else if (desire_location_id == 4) {
                if(document.getElementById('additional_9').checked == true){
                    //jQuery('#additional_9').attr('checked', false);
                    //calculatePrice(document.getElementById('additional_9'));//check if extra stop checkbox is auto checked
                }

                jQuery('.roundTripInfo').hide();
                var city = jQuery('#city').val();
                var hstreet = jQuery('#dstreet').val();
                var hCityFielddrop = jQuery('#hCityFielddrop').val();
                var hstate = jQuery('#hstate option:selected').html();
                var hzip = jQuery('#hzip').val();
                jQuery('.pickuplocation').html(street);
                jQuery('.dropofflocation').html(hstreet);
            }

            if (desire_location_id != 4) {
                jQuery('.errors').html('');
                jQuery('#vhehRates').html('');
                e.preventDefault();
                
                jQuery("html, body").animate({ scrollTop: 0 });

                jQuery.ajax({
                    type: "POST",
                    url: "getRates.php?sendReq=0",
                    data: jQuery('form').serialize(),
                    cache: false,
                    dataType: "json",
                    success: function (data) {
                        jQuery.each(data, function (index, element) {
                            console.log(index);
                            console.log(element);
                            if (index == 'error') {
                                jQuery('.errors').html(element);

                                jQuery('html, body').animate({
                                    scrollTop: jQuery("#errors").offset().top
                                }, 1000);
                            }

                            if (index != 'error') {
                                jQuery('.step-1').hide();
                                jQuery('.step-2').show();
                                jQuery('.veh-btns-wrapper').show();
                                jQuery('.new-res-wrap').show();
                                jQuery('#vhehRates').append(element);
                            }

                        });
                    },
                    error: function (e) {
                        var err = eval("(" + e.responseText + ")");
                        jQuery("#weeklydata").append("<tr class=whtebg><td colspan=7><div class='alert alert-danger'><u>Opps!</u>: " + err.message + "</div></td></tr>");
                    }
                });
                return false;
            } else {
                jQuery('.errors').html('');
                jQuery('#vhehRates').html('');
                e.preventDefault();

                jQuery("html, body").animate({ scrollTop: 0 });

                jQuery.ajax({
                    type: "POST",
                    url: "getCars.php?sendReq=0",
                    data: jQuery('form').serialize(),
                    cache: false,
                    dataType: "json",
                    success: function (data) {
                        jQuery.each(data, function (index, element) {
                            if (index == 'error') {
                                jQuery('.errors').html(element);

                                jQuery('html, body').animate({
                                    scrollTop: jQuery("#errors").offset().top
                                }, 1000);
                            }

                            if (index != 'error' && index != 'total') {

                                jQuery('.step-1').hide();
                                jQuery('.step-2').show();
                                jQuery('.veh-btns-wrapper').show();
                                jQuery('.new-res-wrap').show();
                                jQuery('#vhehRates').append(element);
                            }

                        });
                    },
                    error: function (e) {
                        var err = eval("(" + e.responseText + ")");
                        jQuery("#weeklydata").append("<tr class=whtebg><td colspan=7><div class='alert alert-danger'><u>Opps!</u>: " + err.message + "</div></td></tr>");
                    }
                });
                return false;
            }
        });

        jQuery(".startNew").click(function () {
            jQuery(".search-veh").show();
            jQuery(".change-veh-wrap").hide();
            jQuery(".step-3").hide();
            jQuery(".step-4").hide();
            jQuery(".new-res-wrap").hide();
            jQuery(".filtered-vehicles-list-wrapper").hide();
            jQuery('.tabed-style li').removeClass('active');
            jQuery('.tabed-style li.s1').addClass('active');
            jQuery('.discountPrice').html(0);
            jQuery('.discountPrice').val(0);
            jQuery('.discountmainwrapper').show();
        });

        jQuery(".Changevehicle").click(function () {
            jQuery(".step-2").show();
            jQuery(".step-3").hide();
            jQuery(".step-4").hide();
            jQuery(".change-veh-wrap").hide();
            jQuery('.discountPrice').html(0);
            jQuery('.discountPrice').val(0);
            jQuery('.discountmainwrapper').show();
        });

        function vehdata(vehicle_id, roundvpricetotal, gratuity) {
            var desireLocId = jQuery('#desire_location').val();
            if ( desireLocId == 3 ) {
                jQuery("select[name=round_arrival_airline]").parent().parent().show();
                jQuery("input[name=round_arrival_flight_no]").parent().parent().show();
            } else {
                jQuery("select[name=round_arrival_airline]").val("Select Airline").change();
                jQuery("select[name=round_arrival_airline]").parent().parent().hide();
                jQuery("input[name=round_arrival_flight_no]").val("");
                jQuery("input[name=round_arrival_flight_no]").parent().parent().hide();
            }
            jQuery('.res_pricing').show();
            jQuery('.step-5.additional-pricing').show();
            var grauityCost = (gratuity / 100) * roundvpricetotal;
            grauityCost = Math.round(grauityCost);
            grauityCost = grauityCost.toFixed(2);
            jQuery('.gratuityCharges').val(grauityCost);
            jQuery('#gratuityCharges').html(grauityCost);

            var dt = new Date();
            var AT = convertTime12to24(jQuery("#actual_pick_up_time").val());
            accDate = new Date(dt.getTime());
            accDate.setHours(AT.split(":")[0]);

            console.log(dt);
            console.log(accDate.getHours());
            if ( accDate.getHours() >= 22 ) {
                jQuery('#additional_3').attr('checked', true);
                calculatePrice(document.getElementById('additional_3'));
            } else if (accDate.getHours() == 0) {
                jQuery('#additional_3').attr('checked', true);
                calculatePrice(document.getElementById('additional_3'));
            } else if (accDate.getHours() >= 0 && accDate.getHours() <= 6) {
                jQuery('#additional_3').attr('checked', true);
                calculatePrice(document.getElementById('additional_3'));
            }

            var resPricetotal = parseInt(roundvpricetotal) + parseInt(grauityCost);

            var vehicle_name = jQuery('#vehicle_name' + vehicle_id).val();
            jQuery(".step-2").hide();
            jQuery(".step-3").show();
            jQuery(".change-veh-wrap").show();
            jQuery('.veh_name').html(vehicle_name);
            jQuery('.veh_name_input').val(vehicle_name);
            jQuery('.veh_id_input').val(vehicle_id);
            jQuery('.resPricetotal').val(roundvpricetotal);
            jQuery('.resPricetotal').html(roundvpricetotal);

            jQuery('.actualtotal').val(resPricetotal);
            jQuery('.actualtotal').html(resPricetotal);


            jQuery('.tabed-style li').removeClass('active');
            jQuery('.tabed-style li.s2').addClass('active');
            
            if(document.getElementById('additional_9').checked == true){
                calculatePrice(document.getElementById('additional_9'));//check if extra stop checkbox is auto checked
            }
            if(document.getElementById('additional_18').checked == true){
                calculatePrice(document.getElementById('additional_18'));//check if round extra stop checkbox is auto checked
            }
            jQuery("html, body").animate({ scrollTop: 0 });
        }

        function vehdatah(vehicle_id, roundvpricetotal, gratuity) {
            jQuery('.res_pricing').show();
            jQuery('.step-5.additional-pricing').show();

            var grauityCost = (gratuity / 100) * roundvpricetotal;
            grauityCost = Math.round(grauityCost);
            grauityCost = grauityCost.toFixed(2);

            jQuery('.gratuityCharges').val(grauityCost);
            jQuery('#gratuityCharges').html(grauityCost);

            var dt = new Date();
            var AT = convertTime12to24(jQuery("#actual_pick_up_time").val());
            accDate = new Date(dt.getTime());
            accDate.setHours(AT.split(":")[0]);

            console.log(dt);
            console.log(accDate.getHours());
            if ( accDate.getHours() >= 22 ) {
                jQuery('#additional_3').attr('checked', true);
                calculatePrice(document.getElementById('additional_3'));
            } else if (accDate.getHours() == 0) {
                jQuery('#additional_3').attr('checked', true);
                calculatePrice(document.getElementById('additional_3'));
            } else if (accDate.getHours() >= 0 && accDate.getHours() <= 6) {
                jQuery('#additional_3').attr('checked', true);
                calculatePrice(document.getElementById('additional_3'));
            }

            var resPricetotal = parseInt(roundvpricetotal) + parseInt(grauityCost);

            var vehicle_name = jQuery('#vehicle_name' + vehicle_id).val();
            jQuery(".step-2").hide();
            jQuery(".step-3").show();
            jQuery(".change-veh-wrap").show();
            jQuery('.veh_name').html(vehicle_name);
            jQuery('.veh_name_input').val(vehicle_name);
            jQuery('.veh_id_input').val(vehicle_id);

            jQuery('.actualtotal').val(resPricetotal);
            jQuery('.actualtotal').html(resPricetotal);
            jQuery('#actualtotalinput').val(resPricetotal);
            jQuery('.resPricetotal').val(roundvpricetotal);
            jQuery('.resPricetotal').html(roundvpricetotal);

            jQuery('.tabed-style li').removeClass('active');
            jQuery('.tabed-style li.s2').addClass('active');
            jQuery("html, body").animate({ scrollTop: 0 });
        }

        const convertTime12to24 = (time12h) => {
            const [time, modifier] = time12h.split(' ');

            let [hours, minutes] = time.split(':');

            if (hours === '12') {
                hours = '00';
            }

            if (modifier === 'PM') {
                hours = parseInt(hours, 10) + 12;
            }

            return `${hours}:${minutes}`;
        }

        jQuery('.desire_location2').click(function () {
            jQuery('.desire_location2').removeClass("active");
            jQuery(this).addClass("active");

            var ctype = jQuery(this).attr("data-ctype");
            if (ctype == '1') {
                jQuery('.hCityField').hide();
                jQuery("#desire_location option[value='1']").attr('selected', 'selected');
                jQuery('.detailloc .label_wrapper').html('Pickup From Address:');
                jQuery('.airportloc .label_wrapper').html('Dropoff Address:');
                jQuery('.hdesc').html('Passenger Info If Different:');
                jQuery('.locwrapermain').removeClass('type3');
                jQuery('.locwrapermain').removeClass('type2');
                jQuery('.locwrapermain').removeClass('type4');
                jQuery('.locwrapermain').addClass('type1');
            } else if (ctype == '2') {
                jQuery('.hCityField').hide();
                jQuery("#desire_location option[value='2']").attr('selected', 'selected');
                jQuery('.hdesc').html('Passenger Info If Different:');
                jQuery('.locwrapermain').removeClass('type3');
                jQuery('.locwrapermain').removeClass('type1');
                jQuery('.locwrapermain').removeClass('type4');
                jQuery('.locwrapermain').addClass('type2');
                
            } else if (ctype == '3') {
                jQuery('.hCityField').hide();
                jQuery("#desire_location option[value='3']").attr('selected', 'selected');
                jQuery('.detailloc .label_wrapper').html('Pickup From Address:');
                jQuery('.airportloc .label_wrapper').html('Dropoff Address:');
                jQuery('.hdesc').html('Passenger Info If Different:');
                jQuery('#trip').val('AirPort Round Trip');
                jQuery('.locwrapermain').removeClass('type1');
                jQuery('.locwrapermain').removeClass('type2');
                jQuery('.locwrapermain').removeClass('type4');
                jQuery('.locwrapermain').addClass('type3');
            } else if (ctype == '4') {
                jQuery('.nCityField').hide();
                jQuery('.extrastop').show();
                jQuery('.extradetailloc .label_wrapper').html('Extra Stop Location:');
                jQuery("#desire_location option[value='4']").attr('selected', 'selected');
                jQuery('.detailloc .label_wrapper').html('Pickup From Address:');
                jQuery('.airportloc .label_wrapper').html('Dropoff Address:');
                jQuery('#trip').val('Hourly Rate Service');
                jQuery('.hdesc').html('Description:');
                jQuery('.locwrapermain').removeClass('type3');
                jQuery('.locwrapermain').removeClass('type2');
                jQuery('.locwrapermain').removeClass('type1');
                jQuery('.locwrapermain').addClass('type4');
                jQuery('.hCityField').hide();
            }
        });
    </script>

    <script type="text/javascript">
        function selLocation(obj) {
            var location = obj;
            document.getElementById('pickup_info').style.display = "none";
            document.getElementById('arrival_info').style.display = "none";
            document.getElementById('location_heading').style.display = "";
            if (location == 1) {
                alert('ad');
                document.getElementById('location_heading').innerHTML = "Pick up Location:";
                document.getElementById('pickup_info').style.display = "";
            } else if (location == 2) {
                document.getElementById('location_heading').innerHTML = "Arrival Information:";
                document.getElementById('arrival_info').style.display = "";
            } else {
                alert('ad 3');
                document.getElementById('location_heading').style.display = "none";
            }
        }
        function validateReservation() {
            var dloc = document.getElementById('desire_location').value;
            if (dloc == 0) {
                alert("Please select Desired Location");
                return false;
            }
            return true;
        }

    </script>

    <?php include_once("inc/footer.php") ?>
