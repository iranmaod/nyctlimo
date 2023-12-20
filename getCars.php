<?php

include("includes/open_con.php");
include('session_check.php');

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

if ($_POST['desire_location']) {

    $errors = '';
    if ($_POST['departure_date'] == '')
        $errors .= '- Departure Date is a required field.<br />';

    if ($_POST['street'] == '')
        $errors .= '- Street is a required field.<br />';

    if ($_POST['city'] == '')
        $errors .= '- City is a required field.<br />';

    if ($_POST['state'] == '')
        $errors .= '- State is a required field.<br />';

    if ($_POST['zip'] == '')
        $errors .= '- Zip is a required field.<br />';

    if ($_POST['passengers'] == '')
        $errors .= '- Passengers is a required field.<br />';

    if (!is_numeric($_POST['passengers']))
        $errors .= '- Passengers should be numeric.<br />';

    if (isset($_REQUEST['desire_location']) && $_REQUEST['desire_location'] == 4) {
        if ($_POST['shours'] == '')
            $errors .= '- service hours is a required field.<br />';

        if (!is_numeric($_POST['shours']))
            $errors .= '- service hours should be numeric.<br />';
    }

    if ($errors == '') {
        $priceQry = "select * from doc_vehicles ";
        $price = $db->getAll($priceQry);

        // 1= car up to 3 or 4  passengers
        // $49.99 plus 20 % gratuity  per hour . 4 Hours minimum charges
        // 2=  SUV up to 5 or 6 passengers
        // $69.99 Plus 20 % gratuity per hour 4 Hours minimum charges
        // 3= van up to 10 passengers $100.00 plus
        // 20 % gratuity per hour. 5 Hours minimum charges
        // 4 = stretch limousines up to 10 passengers $100.00 plus 20 % gratuity .5 Hours minimum charges

        $rateRes = '';
        $vcounter = 0;
        foreach ($price as $key => $vehicle) {
            $price = '';
            $roundvprice = '';
            $roundvdestination_id = '';
            $roundvpricetotal = 0;
            $vcounter++;
            if ($vehicle['id'] == 2) {
                // Sedans - 3 Passengers 3 Baggage
                $price = $vehicle['hour_price'];//59.99;
                $vImage = "/uploads/event_49.jpg";
                $mhours = $vehicle['service_hour'];
            } else if ($vehicle['id'] == 5) {
                // Vans - 10 passenger
                $price = $vehicle['hour_price'];//135.00;
                $vImage = "/uploads/event_50.jpg";
                $mhours = $vehicle['service_hour'];
            } else if ($vehicle['id'] == 16) {
                // SUV - 6 Passengers 5 Baggage
                $price = $vehicle['hour_price'];//75.99;
                $vImage = "/uploads/event_51.jpg";
                $mhours = $vehicle['service_hour'];
            } else {//id 07
                // Other
                $price = $vehicle['hour_price'];//135.00;
                $vImage = "/uploads/event_47.jpg";
                $mhours = $vehicle['service_hour'];
            }
            if ($mhours > $_POST['shours']) {
                $_POST['shours'] = $mhours;
            }

            $hours = $_POST['shours'];
            $totalPrice = $price * $hours;

            // $totalPrice = MINIMUM_MILE_PRICE + ( $_POST["distance"] * MILE_PRICE );

            $percentage = 20;
            $gratuity = ($percentage / 100) * $totalPrice;
            $total = $totalPrice + $gratuity;

            $rateRes = '<div class="filtered-vehicles-item filtered-vehicles-' . $key . '">';
            $rateRes .= '<div class="v-img-wrap"><img src="' . $vImage . '" width="200px"/></div>';
            $rateRes .= '<div class="v-detail-wrap">';
            $rateRes .= '<div class="v-title">' . $vehicle['name'] . '</div>';
            $rateRes .= '<div class="v-price" style=" font-size: 14px; text-align: right; ">';
            $rateRes .= '$' . $price . ' per hour<br>';
            // $rateRes .= '$' . MINIMUM_MILE_PRICE + ( $_POST["distance"] * MILE_PRICE ) . ' per hour<br>';
            $rateRes .= '20% gratuity.';
            $rateRes .= '</div>';
            $rateRes .= '<div class="v-desc"><p>' . $vehicle['description'] . '</p><p>Minimum Hours: ' . $mhours . '</p></div>';

            $rateRes .= '<div class="v-res-btn-wrap">';
            $rateRes .= '<input type="hidden" value="' . $vehicle['name'] . '" name="vehicle_name" id="vehicle_name' . $vehicle['id'] . '" />';
            $rateRes .= '<button type="button" class="buttons" id="vid-' . $vehicle['id'] . '" name="vid-' . $vehicle['id'] . '" onclick="vehdatah(' . $vehicle['id'] . ', ' . $totalPrice . ', ' . 20 . ');">Reserve Now</button>';
            $rateRes .= '</div>';
            $rateRes .= '</div>';
            $rateRes .= '</div>';
            $rateRes .= '<hr/>';

            $rateResult[] = $rateRes;
        }

        if ($vcounter != 0 && $_REQUEST['sendReq'] == 0) {
            echo json_encode($rateResult);
        }

        if ($vcounter == 0) {
            $datar['error'] = 'No Vehical Found Based On Query';
            if ($_REQUEST['sendReq'] == 0) {
                echo json_encode($datar);
            }
        }
    } else {
        $datar['error'] = $errors;
        if ($_REQUEST['sendReq'] == 0) {
            echo json_encode($datar);
        }
    }


    if ($_REQUEST['sendReq'] == 1) {
        if ($_POST['name'] == '')
            $errors .= '- Name is a required field.<br />';

        if ($_POST['lastname'] == '')
            $errors .= '- Last Name is a required field.<br />';

        if ($_POST['phone'] == '')
            $errors .= '- Phone Number is a required field.<br />';

        if ($_POST['email'] == '')
            $errors .= '- Email is a required field.<br />';

        if ($errors == '') {
            extract($_POST);
            $serial_no = 'TCL100';
            $desc = '';
            $additional = isset($_POST['additional']) ? serialize($_POST['additional']) : '';

            $datav['type'] = 'reservation';

            $datav['additional'] = $additional;
            $datav['name'] = $name;
            $datav['lastname'] = $lastname;

            $datav['phone'] = $phone;
            $datav['contact'] = $cellphone;
            $datav['passengerInfoIfDifferent'] = $passengerInfo;
            $datav['special_instructions'] = $driverNote;
            $datav['CustomAdditionalCharges'] = $CustomAdditionalCharges;
            $datav['gratuity'] = $gratuityCharges;
            $datav['email'] = $email;

            $datav['vehicle'] = $vehId;
            $datav['passengers'] = $passengers;
            $datav['actual_pick_up_time'] = $shours;

            $datav['street'] = $street;
            $datav['city'] = $city;
            $datav['state'] = $state;
            $datav['zip'] = $zip;
            // $datav['pickup_location'] = $street . ' ' . $city . ' ' . $state . ' ' . $zip;
            $datav['pickup_location'] = $street;

            $datav['street2'] = $hstreet;
            $datav['city2'] = $hcity;
            $datav['state2'] = $hstate;
            $datav['zip2'] = $hzip;
            // $datav['dropoff_location'] = $hstreet . ' ' . $hcity . ' ' . $hstate . ' ' . $hzip;
            $datav['dropoff_location'] = $dstreet;

            $datav['status'] = 0;


            $datav['added_date'] = date("Y-m-d H:i:s");

            $datav['transactionid'] = '';
            $datav['desire_location'] = $desire_location;
            $datav['payment_type'] = '';
            $datav['coupon_price'] = '';

            if ($_POST['desire_location'] == 4) {
                $datav['trip'] = 'Hourly Reservation'; // one way, round
                $datav['departure_date'] = $departure_date;
                $datav['departure_airport'] = $arrival_airport;
                $datav['other_airport'] = '';
                $datav['departure_airline'] = '';
                $datav['other_airline'] = '';
                $datav['flight_time'] = '';
                $datav['flight_am'] = '';
                $datav['actual_pick_up_time'] = $actual_pick_up_time;

				$datav['extra_street'] = $extra_street;
            	$datav['extra_city'] = $extra_city;
            	$datav['extra_state'] = $extra_state;
            	$datav['extra_zip'] = $extra_zip;
            	// $datav['extra_stop_location'] = $extra_street . ' ' . $extra_city . ' ' . $extra_state . ' ' . $extra_zip;
            	$datav['extra_stop_location'] = $extra_street;

                $datav['drop_address'] = $dstreet;
            }

            $table = "reservations";
            $getHSer = $db->GetRow("SELECT * FROM " . DB_TABLE_PREFIX . "hourly_reservations ORDER BY serial_temp DESC LIMIT 1");

            $hser = $getHSer['serial_temp'] + 1;

            $datav['serial_temp'] = $hser;
            $datav['serial_no'] = 'HNYCT' . $hser;


            if ($vehId == 2) {
                //    Sedans - 3 Passengers 3 Baggage
                $price = $vehicle['hour_price'];//49.99;
                $vImage = "/uploads/event_49.jpg";
                $mhours = $vehicle['service_hour'];
            } else if ($vehId == 5) {
                //    Vans - 10 passenger
                $price = $vehicle['hour_price'];//100.00;
                $vImage = "/uploads/event_50.jpg";
                $mhours = $vehicle['service_hour'];
            } else if ($vehId == 16) {
                //    SUV - 6 Passengers 5 Baggage
                $price = $vehicle['hour_price'];//69.99;
                $vImage = "/uploads/event_51.jpg";
                $mhours = $vehicle['service_hour'];
            } else {
                //    Other
                $price = $vehicle['hour_price'];//100.00;
                $vImage = "/uploads/event_47.jpg";
                $mhours = $vehicle['service_hour'];
            }

            if ($mhours > $_POST['shours']) {
                $_POST['shours'] = $mhours;
            }

            $hours = $_POST['shours'];
            $totalPrice = $price * $hours;

            // $totalPrice = MINIMUM_MILE_PRICE + ( $_POST["distance"] * MILE_PRICE );

            $percentage = 20;
            $gratuity = ($percentage / 100) * $totalPrice;

            $total = $totalPrice + $gratuity;


            $datav['hourly_rate'] = $price;
            $datav['total_hours'] = $hours;
            $datav['gratuity'] = $gratuity;
            $datav['finalprice'] = $_POST["actualtotal"];
            $datav['comments'] = $passengerInfo;

            foreach ($datav as $key => $val) {
                $str [] = "$key = '" . addslashes($val) . "' ";
            }

            $string = implode(",", $str);
            $lastId = '';

            $db->Execute("insert into " . DB_TABLE_PREFIX . "hourly_reservations set $string, user_id = 0, card_address = '', card_state = '', card_zip = '', arrival_date = '', arrival_time = '', arrival_am = '', arrival_airport = '', other_airport2 = '', arrival_airline = '', other_airline2 = '', flight_no = '', actual_arrival_time = '', actual_arrival_am = '', actual_pick_up_time_am = '', actual_drop_off_time = '', actual_drop_off_time_am = '', toll_price = ''");
            $lastId = $db->insert_Id();
            $_SESSION['lastId'] = $lastId;
            $_SESSION['res_type'] = 'hourly';
            $table = "hourly_reservations";
            $data = $db->GetRow("select * from " . DB_TABLE_PREFIX . "$table where id ='" . $lastId . "' order by id desc");
            @extract($data);

            $html = '<p>Dear ' . $name . ', <br><br> Thanks for requesting a reservation. We will contact you shortly.</p>';
            $html .= '<p><strong><i>Reservation ID:</i> ' . $serial_no . '</strong></p>';
            $html .= '<p><strong><i>Per Hour Rate:</i> $' . $price . '</strong></p>';
            $html .= '<p><strong><i>Sub Total:</i> $' . $totalPrice . '</strong> (for ' . $shours . 'h)</p>';
            $html .= '<p><strong><i>Gratuity:</i> $' . $gratuity . '</strong></p>';
            $html .= '<p><strong><i>Discount:</i> $' . $_POST['discountPrice'] . '</strong></p>';
            $html .= '<p><strong><i>Total:</i> $' . $total . '</strong></p>';
            $html .= '<br>';
            $html .= '<table cellpadding="5" border="0" cellspacing="1">';
            $html .= '<tbody>';
            $html .= '<tr>';
            $html .= '<td valign="top" colspan="3"><h2>Reservation Detail:</h2></td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td width="200" valign="top" class="text">Quote or Reservation:</td>';
            $html .= '<td valign="top" colspan="2">' . $desc . '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td valign="top" class="text">Name:  </td>';
            $html .= '<td valign="top" class="text" colspan="2">' . $name . '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td valign="top" class="text">Last Name:  </td>';
            $html .= '<td valign="top" class="text" colspan="2">' . $lastname . '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td valign="top" class="text">Phone Number:</td>';
            $html .= '<td valign="top" class="text" colspan="2">' . $phone . '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<tr>';
            $html .= '<td valign="top" class="text">Cell Phone:</td>';
            $html .= '<td valign="top" class="text" colspan="2">' . $cellphone . '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td valign="top" class="text"> E-mail: </td>';
            $html .= '<td valign="top" colspan="2">' . $email . '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td valign="top" class="text"> Passenger info if different: </td>';
            $html .= '<td valign="top" colspan="2">' . $passengerInfo . ' </td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td valign="top" class="text"> Driver Note: </td>';
            $html .= '<td valign="top" colspan="2">' . $driverNote . ' </td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td valign="top" class="text"> Vehicle Type:</td>';
            $html .= '<td valign="top" colspan="2">' . $vehName . ' </td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td valign="top" class="text"> No of passengers:</td>';
            $html .= '<td valign="top" colspan="2">' . $passengers . ' </td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td valign="top" class="text"> Service Hours:</td>';
            $html .= '<td valign="top" colspan="2">' . $shours . ' </td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td valign="top" class="text"> One way or Round trip?:*</td>';
            $html .= '<td valign="top" colspan="2">Hourly Rate Service</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td valign="top" colspan="3"><h2>Pick Up Information:</h2></td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td valign="top" class="text">Pick Up Date:</td>';
            $html .= '<td valign="top" colspan="2">' . $departure_date . '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td valign="top" class="text">Pick Up Time:</td>';
            $html .= '<td valign="top" colspan="2">' . $actual_pick_up_time . '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td valign="top" class="text">Street:</td>';
            $html .= '<td valign="top" colspan="2">' . $street . '</td>';
            $html .= '</tr>';
            // $html .= '<tr>';
            // $html .= '<td valign="top" class="text">City:</td>';
            // $html .= '<td valign="top" colspan="2">' . $hCityField . '</td>';
            // $html .= '</tr>';
            // $html .= '<tr>';
            // $html .= '<td valign="top" class="text">State:</td>';
            // $html .= '<td valign="top" colspan="2">' . $state . '</td>';
            // $html .= '</tr>';
            // $html .= '<tr>';
            // $html .= '<td valign="top" class="text">Zip:</td>';
            // $html .= '<td valign="top" colspan="2">' . $zip . '</td>';
            // $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td valign="top" colspan="3"><h2>Dropoff Address:</h2></td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td valign="top" class="text">Street:</td>';
            $html .= '<td valign="top" colspan="2">' . $dstreet . '</td>';
            $html .= '</tr>';
            // $html .= '<tr>';
            // $html .= '<td valign="top" class="text">City:</td>';
            // $html .= '<td valign="top" colspan="2">' . $hCityFielddrop . '</td>';
            // $html .= '</tr>';
            // $html .= '<tr>';
            // $html .= '<td valign="top" class="text">State:</td>';
            // $html .= '<td valign="top" colspan="2">' . $hstate . '</td>';
            // $html .= '</tr>';
            // $html .= '<tr>';
            // $html .= '<td valign="top" class="text">Zip:</td>';
            // $html .= '<td valign="top" colspan="2">' . $hzip . '</td>';
            // $html .= '</tr>';
            $html .= '</tbody>';
            $html .= '</table>';


            $_SESSION['emailhtml'] = $html;

            $_SESSION['reservation'] = $_POST;


            $datar['payment'] = 'Thanks for requesting a reservation. Please make a payment with secured STRIPE payment gateway.';

            echo json_encode($datar);
        } else if ($errors != '') {
            $datar['error'] = $errors;
            echo json_encode($datar);
        }
    }
}
?>