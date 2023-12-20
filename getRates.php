<?php
// echo 'test'; exit;
include("includes/open_con.php");
include('session_check.php');
// ini_set('display_errors',  true);

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

    // if ($_POST['city'] == '')
    //     $errors .= '- City is a required field.<br />';

    if ($_POST['state'] == '')
        $errors .= '- State is a required field.<br />';

    if ($_POST['zip'] == '')
        $errors .= '- Zip is a required field.<br />';

    if ($_POST['passengers'] == '')
        $errors .= '- Passengers is a required field.<br />';

    if (!is_numeric($_POST['passengers']))
        $errors .= '- Passengers should be numeric.<br />';

    if (isset($_REQUEST['desire_location']) && $_REQUEST['desire_location'] == 3) {
        if ($_POST['round_departure_date'] == '')
            $errors .= '- Round Trip date is missing.<br />';

        if ($_POST['round_actual_pick_up_time'] == '')
            $errors .= '- Round Trip time is missing.<br />';

        if ($_POST['round_arrival_airport'] == '')
            $errors .= '- Round Trip airport is missing.<br />';

        if ($_POST['round_street'] == '')
            $errors .= '- Round Trip street is missing.<br />';

        if ($_POST['round_city'] == '')
            $errors .= '- Round Trip city is missing.<br />';

        if ($_POST['round_state'] == '')
            $errors .= '- Round Trip state is missing.<br />';

        // if ($_POST['round_zip'] == '')
        //     $errors .= '- Round Trip zip is missing.<br />';
    }

    foreach ($_POST as $key => $val) {
        $$key = (!is_array($val)) ? addslashes($val) : '';
    }

    if ($errors == '') {
        $priceQry = "select * from doc_vehicles ";
        // $priceQry = "select doc_quoteprices.id, doc_quoteprices.vehicle_id, doc_quoteprices.gratuity, doc_quoteprices.tax_price, "
        //         . "doc_quoteprices.additional_charges, doc_quoteprices.destination_id, doc_vehicles.name, doc_vehicles.description, doc_vehicles.price "
        //         . "from doc_quoteprices "
        //         . "INNER JOIN doc_vehicles ON doc_quoteprices.vehicle_id = doc_vehicles.id "
        //         // . "where doc_quoteprices.airport_id = " . $_POST['arrival_airport'] . " "
        //         // . "and doc_quoteprices.destination_id = " . $_POST['city'];
        //         . "where doc_quoteprices.destination_id = " . $_POST['city']
        //         ;

        $price = $db->getAll($priceQry);

        if (isset($_REQUEST['desire_location']) && $_REQUEST['desire_location'] == 3) {
            $roundpriceQry = "select doc_quoteprices.*, doc_vehicles.name, doc_vehicles.description "
                    . "from doc_quoteprices "
                    . "INNER JOIN doc_vehicles ON doc_quoteprices.vehicle_id = doc_vehicles.id "
                    . "where doc_quoteprices.airport_id = " . $_POST['round_arrival_airport'] . " "
                    . "and doc_quoteprices.destination_id = " . $_POST['round_city'];
            $roundprice = $db->getAll($roundpriceQry);
        }
        $rateRes = '';
        $vcounter = 0;

        $distance = (int) str_replace(',','',$_POST["distance"]);

        $rateResult = array();
        foreach ($price as $key => $vehicle) {
            // if (in_array($vehicle["vehicle_id"], $vExists)) {
            //     continue;
            // }
            // $vExists[] = $vehicle["vehicle_id"];
            $roundvprice = '';
            $roundvdestination_id = '';

            // $roundvpricetotal = $vehicle['price'];
            $roundvpricetotal = ($distance > 30) ? ($vehicle['price'] + ( ($distance-30) * $vehicle['mile'] )) : $vehicle['price'];
            $maintotalPrice = $roundvpricetotal;

            if (isset($_REQUEST['desire_location']) && $_REQUEST['desire_location'] == 3) {
                // if (isset($roundprice)) {
                //     foreach ($roundprice as $value2) {
                //         if ($vehicle['id'] === $value2['id']) {
                $roundvprice = ($_POST["round_distance"] > 30) ? ($vehicle['price'] + ( ($_POST["round_distance"]-30) * $vehicle['mile'] )) : $vehicle['price'];
                //             $roundvpricetotal = $vehicle['price'] + $roundvprice;
                //             // $roundvdestination_id = $value2['destination_id'];
                //         }
                //     }
                // }
                $maintotalPrice += $roundvprice;
            }

            $vcounter++;
            if ($vehicle['id'] == 2) {
                $vImage = "/uploads/event_49.jpg";
            } else if ($vehicle['id'] == 5) {
                $vImage = "/uploads/event_50.jpg";
            } else if ($vehicle['id'] == 16) {
                $vImage = "/uploads/event_51.jpg";
            } else {
                $vImage = "/uploads/event_47.jpg";
            }

            // $rateRes = '<input type="hidden" value="' . $vehicle['destination_id'] . '" name="destination1" />';
            // $rateRes .= '<input type="hidden" value="' . $roundvdestination_id . '" name="destination2" />';
            $rateRes = '<div class="filtered-vehicles-item filtered-vehicles-' . $key . '">';
            $rateRes .= '<div class="v-img-wrap"><img src="' . $vImage . '" width="200px"/></div>';
            $rateRes .= '<div class="v-detail-wrap">';
            $rateRes .= '<div class="v-title">' . $vehicle['name'] . '</div>';
            $rateRes .= '<div class="v-price">';
            // $rateRes .= ($vehicle['price'] == 0 ? 'No vehical found' : '$' . $vehicle['price']);
            // if ($vehicle['price'] == 0) {
            //     $rateRes .= 'No vehical found';
            // } else {
                $rateRes .= '$' . round($roundvpricetotal, 2);
            // }
            
            if (!empty($roundvprice)) {
                $rateRes .= ' + $' . round($roundvprice, 2) . ' = $' . round(($roundvpricetotal + $roundvprice), 2);
            } else if (empty($roundvprice) && $_REQUEST['desire_location'] == 3) {
                $rateRes .= '- Not available  for return';
            }
            $rateRes .= '</div>';
            $rateRes .= '<div class="v-desc">' . $vehicle['description'] . '<p></p></div>';

            $rateRes .= '<div class="v-res-btn-wrap">';
            // $rateRes .= '<input type="hidden" value="' . $vehicle['name'] . '" name="vehicle_name" id="vehicle_name' . $vehicle['vehicle_id'] . '" />';
            // $rateRes .= '<button type="button" class="buttons" id="vid-' . $vehicle['vehicle_id'] . '" name="vid-' . $vehicle['vehicle_id'] . '" onclick="vehdata(' . $vehicle['vehicle_id'] . ', ' . $roundvpricetotal . ', ' . $vehicle['gratuity'] . ');">Reserve Now</button>';
            $rateRes .= '<input type="hidden" value="' . $vehicle['name'] . '" name="vehicle_name" id="vehicle_name' . $vehicle['id'] . '" />';
            $rateRes .= '<button type="button" class="buttons" id="vid-' . $vehicle['id'] . '" name="vid-' . $vehicle['id'] . '" onclick="vehdata(' . $vehicle['id'] . ', ' . round($maintotalPrice, 2) . ', ' . 20 . ');">Reserve Now</button>';
            $rateRes .= '</div>';
            $rateRes .= '</div>';
            $rateRes .= '</div>';
            $rateRes .= '<hr/>';

            // echo $key . "-" . $vehicle['id'] . "\n";

            $rateResult[] = $rateRes;
        }
// exit;
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
            $desc = '';
            $additional = ( isset($_POST['additional']) && !empty($_POST['additional']) ) ? serialize($_POST['additional']) : '';
            $arrival_date = ( isset($_POST['arrival_date']) && !empty($_POST['arrival_date']) ) ? $_POST['arrival_date'] : '';
            $arrival_time = ( isset($_POST['arrival_time']) && !empty($_POST['arrival_time']) ) ? $_POST['arrival_time'] : '';
            $arrival_am = ( isset($_POST['arrival_am']) && !empty($_POST['arrival_am']) ) ? $_POST['arrival_am'] : '';
            $arrival_airline = ( isset($_POST['arrival_airline']) && !empty($_POST['arrival_airline']) ) ? $_POST['arrival_airline'] : '';

            $datav['type'] = 'reservation';

            $datav['additional'] = $additional;
            $datav['name'] = $name;
            $datav['lastname'] = $lastname;

            $datav['phone'] = $phone;
            $datav['cellphone'] = $cellphone;
            $datav['passengerInfoIfDifferent'] = $passengerInfo;
            $datav['driverNote'] = $driverNote;
            $datav['CustomAdditionalCharges'] = $CustomAdditionalCharges;
            $datav['gratuity'] = $gratuityCharges;
            $datav['email'] = $email;
            $datav['contact'] = ''; //Which Method use for contact back
            $datav['vehicle'] = $vehId;
            $datav['passengers'] = $passengers;

            $datav['street'] = $street;
            $datav['city'] = $city;
            $datav['state'] = $state;
            $datav['zip'] = $zip;
            $datav['status'] = 0;
			
			$datav['extra_street'] = $extra_street;
           	$datav['extra_city'] = $extra_city;
           	$datav['extra_state'] = $extra_state;
           	$datav['extra_zip'] = $extra_zip;
           	$datav['extra_stop_location'] = $extra_street;
			
			$datav['round_extra_street'] = $round_extra_street;
           	$datav['round_extra_city'] = $round_extra_city;
           	$datav['round_extra_state'] = $round_extra_state;
           	$datav['round_extra_zip'] = $round_extra_zip;
           	$datav['round_extra_stop_location'] = $round_extra_street;

            $datav['finalprice'] = $actualtotal;
            $datav['added_date'] = date("Y-m-d H:i:s");

            $datav['comments'] = '';

            $datav['status'] = 1;
            $datav['serial_no'] = '';
            $datav['serial_temp'] = '';
            $datav['transactionid'] = '';
            $datav['desire_location'] = $desire_location;
            $datav['payment_type'] = '';
            $datav['coupon_price'] = 0;
            $datav['flight_no'] = $flight_no;

            $datav['departure_date'] = '';
            $datav['other_airport'] = '';
            $datav['departure_airline'] = '';
            $datav['other_airline'] = '';
            $datav['flight_time'] = '';
            $datav['flight_am'] = '';
            $datav['actual_pick_up_time'] = '';
            $datav['card_address'] = '';
            $datav['card_state'] = '';
            $datav['card_zip'] = '';
            $datav['arrival_am'] = '';
            $datav['other_airport2'] = '';
            $datav['arrival_airline'] = '';
            $datav['other_airline2'] = '';
            $datav['drop_address'] = '';
            $datav['actual_arrival_time'] = '';
            $datav['actual_arrival_am'] = '';
            $datav['actual_pick_up_time_am'] = '';
            $datav['airline'] = '';
            $datav['departure_airport'] = '';
            $datav['arrival_date'] = '';
            $datav['arrival_time'] = '';
            $datav['street2'] = '';
            $datav['city2'] = '';
            $datav['state2'] = '';
            $datav['zip2'] = '';
            $datav['round_departure_date'] = '';
            $datav['round_actual_pick_up_time'] = '';
            $datav['round_actual_pick_up_time_am'] = '';
            $datav['round_arrival_airport'] = '';
            $datav['round_departure_airline'] = '';
            $datav['round_flight_no'] = '';
            $datav['round_street'] = '';
            $datav['round_city'] = '';
            $datav['round_state'] = '';
            $datav['round_zip'] = '';
            $datav['balance_transaction'] = '';
            $datav['stripe_customer_id'] = '';

            if ($_POST['desire_location'] == 1) {
                $datav['trip'] = 'One Way To Airport'; // one way, round
                $datav['departure_date'] = $departure_date;
                $datav['arrival_airport'] = $arrival_airport;
                $datav['other_airport'] = '';
                $datav['departure_airline'] = $departure_airline;
                $datav['other_airline'] = '';
                $datav['flight_time'] = '';
                $datav['flight_am'] = '';
                $datav['actual_pick_up_time'] = $actual_pick_up_time;
                $datav['drop_address'] = $dstreet;
                $datav['city2'] = $hCityField;
                $datav['state2'] = $hstate;
                $datav['zip2'] = $hzip;
                // $datav['actual_pick_up_time_am'] = $actual_pick_up_time_am;
            } else if ($_POST['desire_location'] == 2) {
                $datav['trip'] = 'One Way From Airport'; // one way, round
                $datav['arrival_date'] = $departure_date;
                $datav['arrival_time'] = $actual_pick_up_time;
                // $datav['arrival_am'] = $actual_pick_up_time_am;
                $datav['arrival_airport'] = $arrival_airport;
                $datav['other_airport2'] = '';
                $datav['arrival_airline'] = $departure_airline;
		$datav['departure_airline'] = $departure_airline;
                $datav['other_airline2'] = '';
                // $datav['flight_no'] = '';
                $datav['actual_arrival_time'] = $actual_pick_up_time;
                // $datav['actual_arrival_am'] = $actual_pick_up_time_am;
                $datav['drop_address'] = $dstreet;
                $datav['city2'] = $hCityField;
                $datav['state2'] = $hstate;
                $datav['zip2'] = $hzip;
            } else if ($_POST['desire_location'] == 3) {
                $datav['trip'] = 'Round Trip To Airport'; // one way, round
                $datav['departure_date'] = $departure_date;
                $datav['round_departure_date'] = $round_departure_date;
                $datav['round_actual_pick_up_time'] = $round_actual_pick_up_time;
                // $datav['round_actual_pick_up_time_am'] = $round_actual_pick_up_time_am;
                $datav['round_arrival_airport'] = $round_arrival_airport;
                $datav['arrival_airport'] = $arrival_airport;
                $datav['arrival_airline'] = $departure_airline;
		        $datav['departure_airline'] = $departure_airline;
                $datav['actual_pick_up_time'] = $actual_pick_up_time;
                // $datav['actual_pick_up_time_am'] = $actual_pick_up_time_am;

                $datav['round_departure_airline'] = ( isset($_POST['round_arrival_airline']) && !empty($_POST['round_arrival_airline']) ) ? $_POST['round_arrival_airline'] : '';;
                $datav['round_flight_no'] = ( isset($_POST['round_arrival_flight_no']) && !empty($_POST['round_arrival_flight_no']) ) ? $_POST['round_arrival_flight_no'] : '';;
                $datav['round_street'] = $round_street;
                $datav['round_city'] = $round_city;
                $datav['round_state'] = $round_state;
                $datav['round_zip'] = $round_zip;
                $datav['drop_address'] = $dstreet;
            }
// echo'<pre>';
// print_r($_POST);
// print_r($datav);
// exit;
            $table = "reservations";
            $getHSer = $db->GetRow("SELECT * FROM " . DB_TABLE_PREFIX . "reservations ORDER BY serial_temp DESC LIMIT 1");

            $hser = $getHSer['serial_temp'] + 1;

            $datav['serial_temp'] = $hser;
            $datav['serial_no'] = 'NYCT' . $hser;

            foreach ($datav as $key => $val) {
                $str [] = "$key = '" . addslashes($val) . "' ";
            }

            $string = implode(",", $str);

// echo "insert into " . DB_TABLE_PREFIX . "reservations set $string";
// exit;
            $result = $db->Execute("insert into " . DB_TABLE_PREFIX . "reservations set $string, user_id = 0");
            // echo'<pre>';print_r($result);exit;
            $lastId = $db->insert_Id();
            $_SESSION['lastId'] = $lastId;

            $table = "reservations";
            $data = $db->GetRow("select * from " . DB_TABLE_PREFIX . "$table where id ='" . $lastId . "' order by id desc");
            @extract($data);

            $html1 = '<p>Dear ' . $name . ', <br><br> Thanks for requesting a reservation. Please make a payment with secured STRIPE payment gateway.</p>';
            $html = '<table cellpadding="5" border="0" cellspacing="1">';
            $html .= '<tbody>';
            $html .= '<tr>';
            $html .= '<td valign="top" colspan="3"><h2>Reservation Detail:</h2></td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td valign="top" colspan="3"><strong><i>Total Amount:</i> $' . $actualtotal . '</strong></td>';
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
            $html .= '<td valign="top" colspan="2">' . $passengerInfo . '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td valign="top" class="text"> Driver Note: </td>';
            $html .= '<td valign="top" colspan="2">' . $driverNote . '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td valign="top" class="text"> Vehicle Type:</td>';
            $html .= '<td valign="top" colspan="2">' . $vehName . '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td valign="top" class="text"> No of passengers:</td>';
            $html .= '<td valign="top" colspan="2">' . $passengers . '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td valign="top" class="text"> One way or Round trip?:*</td>';
            $html .= '<td valign="top" colspan="2">' . $datav['trip'] . '</td>';
            $html .= '</tr>';

            if ($desire_location == 1 || $desire_location == 3) {
                $arrival_airport = $db->GetOne("select name from " . DB_TABLE_PREFIX . "airports where id ='" . $arrival_airport . "'");
                $html .= '<tr>';
                $html .= '<td valign="top" colspan="3"><h2>Pick Up Information:</h2></td>';
                $html .= '</tr>';
                $html .= '<tr>';
                $html .= '<td valign="top" class="text">Pick Up Date:</td>';
                $html .= '<td valign="top" colspan="2">' . $departure_date . '</td>';
                $html .= '</tr>';
                $html .= '<tr>';
                $html .= '<td valign="top" class="text">Pick Up Time:</td>';
                // $html .= '<td valign="top" colspan="2">' . $actual_pick_up_time . $actual_pick_up_time_am . '</td>';
                $html .= '<td valign="top" colspan="2">' . $actual_pick_up_time . '</td>';
                $html .= '</tr>';
                $html .= '<tr>';
                $html .= '<td valign="top" class="text">Street:</td>';
                $html .= '<td valign="top" colspan="2">' . $street . '</td>';
                $html .= '</tr>';
                $html .= '<tr>';
                // $html .= '<td valign="top" class="text">City:</td>';
                // $city = $db->GetOne("select name from " . DB_TABLE_PREFIX . "destinations where id ='" . $city . "'");
                // $html .= '<td valign="top" colspan="2">' . @$city . '</td>';
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
                $html .= '<td valign="top" colspan="3"><h2>Drop Off Information:</h2></td>';
                $html .= '</tr>';
                $html .= '<tr>';
                $html .= '<td valign="top" class="text">Street:</td>';
                $html .= '<td valign="top" colspan="2">' . @$dstreet . '</td>';
                $html .= '</tr>';
                // $html .= '<tr>';
                // $html .= '<td valign="top" class="text">City:</td>';
                // $html .= '<td valign="top" colspan="2">' . $city2 . '</td>';
                // $html .= '</tr>';
                // $html .= '<tr>';
                // $html .= '<td valign="top" class="text">State:</td>';
                // $html .= '<td valign="top" colspan="2">' . $state2 . '</td>';
                // $html .= '</tr>';
                // $html .= '<tr>';
                // $html .= '<td valign="top" class="text">Zip:</td>';
                // $html .= '<td valign="top" colspan="2">' . $zip2 . '</td>';
                // $html .= '</tr>';
                if ($desire_location == 1) {
                    // $html .= '<tr>';
                    // $html .= '<td valign="top" class="text">Airline:</td>';
                    // $html .= '<td valign="top" colspan="2">' . $departure_airline . '</td>';
                    // $html .= '</tr>';
                }
                if ($desire_location == 3) {

                    // $html .= '<tr>';
                    // $html .= '<td valign="top" class="text">Airline:</td>';
                    // $html .= '<td valign="top" colspan="2">' . $_POST['departure_airline'] . '</td>';
                    // $html .= '</tr>';

                    $html .= '<tr>';
                    $html .= '<td valign="top" colspan="3"><h2>Round Pick Up Information:</h2></td>';
                    $html .= '</tr>';
                    $html .= '<tr>';
                    $html .= '<td valign="top" class="text">Pick Up Date:</td>';
                    $html .= '<td valign="top" colspan="2">' . $round_departure_date . '</td>';
                    $html .= '</tr>';
                    $html .= '<tr>';
                    $html .= '<td valign="top" class="text">Pick Up Time:</td>';
                    // $html .= '<td valign="top" colspan="2">' . $round_actual_pick_up_time . $round_actual_pick_up_time_am . '</td>';
                    $html .= '<td valign="top" colspan="2">' . $round_actual_pick_up_time . '</td>';
                    $html .= '</tr>';
                    $html .= '<tr>';
                    $html .= '<td valign="top" class="text">Departing Address:</td>';
                    // $round_arrival_airport = $db->GetOne("select name from " . DB_TABLE_PREFIX . "airports where id ='" . $round_arrival_airport . "'");
                    $html .= '<td valign="top" colspan="2">' . $round_arrival_airport . '</td>';
                    $html .= '</tr>';
                    if(isset($_POST['round_arrival_airline']) && !empty($_POST['round_arrival_airline'])){
                        $html .= '<tr>';
                        $html .= '<td valign="top" class="text">Departure Airline:</td>';
                        $html .= '<td valign="top" colspan="2">' . $_POST['round_arrival_airline'] . '</td>';
                        $html .= '</tr>';
                    }
                    if(isset($_POST['round_arrival_flight_no']) && !empty($_POST['round_arrival_flight_no'])){
                        $html .= '<tr>';
                        $html .= '<td valign="top" class="text">Departure Fight No:</td>';
                        $html .= '<td valign="top" colspan="2">' . $_POST['round_arrival_flight_no'] . '</td>';
                        $html .= '</tr>';
                    }
                    $html .= '<tr>';
                    $html .= '<td valign="top" colspan="3"><h2>Round Drop Off Information:</h2></td>';
                    $html .= '</tr>';
                    $html .= '<tr>';
                    $html .= '<td valign="top" class="text">Street:</td>';
                    $html .= '<td valign="top" colspan="2">' . $round_street . '</td>';
                    $html .= '</tr>';
                    // $html .= '<tr>';
                    // $html .= '<td valign="top" class="text">City:</td>';
                    // $round_city = $db->GetOne("select name from " . DB_TABLE_PREFIX . "destinations where id ='" . $round_city . "'");
                    // $html .= '<td valign="top" colspan="2">' . $round_city . '</td>';
                    // $html .= '</tr>';
                    // $html .= '<tr>';
                    // $html .= '<td valign="top" class="text">State:</td>';
                    // $html .= '<td valign="top" colspan="2">' . $round_state . '</td>';
                    // $html .= '</tr>';
                    // $html .= '<tr>';
                    // $html .= '<td valign="top" class="text">Zip:</td>';
                    // $html .= '<td valign="top" colspan="2">' . $round_zip . '</td>';
                    // $html .= '</tr>';
                }
            }


            if ($desire_location == 2) {
                $html .= '<tr>';
                $html .= '<td valign="top" colspan="3"><h2>Pick Up Information:</h2></td>';
                $html .= '</tr>';
                $html .= '<tr>';
                $html .= '<td valign="top" class="text">Pick Up Date:</td>';
                $html .= '<td valign="top" colspan="2">' . $arrival_date . '</td>';
                $html .= '</tr>';
                $html .= '<tr>';
                $html .= '<td valign="top" class="text">Pick Up Time:</td>';
                $html .= '<td valign="top" colspan="2">' . $arrival_time . $arrival_am . '</td>';
                $html .= '</tr>';
                // $html .= '<tr>';
                // $html .= '<td valign="top" class="text">Departing Airport:</td>';
                // $arrival_airport = $db->GetOne("select name from " . DB_TABLE_PREFIX . "airports where id ='" . $arrival_airport . "'");
                // $html .= '<td valign="top" colspan="2">' . $arrival_airport . '</td>';
                // $html .= '</tr>';
                $html .= '<tr>';

                $html .= '<tr>';
                $html .= '<td valign="top" class="text">Street:</td>';
                $html .= '<td valign="top" colspan="2">' . $street . '</td>';
                $html .= '</tr>';
                // $html .= '<tr>';
                // $html .= '<td valign="top" class="text">City:</td>';
                // $city = $db->GetOne("select name from " . DB_TABLE_PREFIX . "destinations where id ='" . $city . "'");
                // $html .= '<td valign="top" colspan="2">' . $city . '</td>';
                // $html .= '</tr>';
                // $html .= '<tr>';
                // $html .= '<td valign="top" class="text">State:</td>';
                // $html .= '<td valign="top" colspan="2">' . $state . '</td>';
                // $html .= '</tr>';
                // $html .= '<tr>';
                // $html .= '<td valign="top" class="text">Zip:</td>';
                // $html .= '<td valign="top" colspan="2">' . $zip . '</td>';
                // $html .= '</tr>';
                // $html .= '<tr>';
                // $html .= '<td valign="top" class="text">Airline:</td>';
                // $html .= '<td valign="top" colspan="2">' . $arrival_airline . '</td>';
                // $html .= '</tr>';
                // $html .= '<tr>';
                // $html .= '<td valign="top" class="text">Flight #:</td>';
                // $html .= '<td valign="top" colspan="2">' . $flight_no . '</td>';
                // $html .= '</tr>';
                $html .= '<tr>';
                $html .= '<td valign="top" colspan="3"><h2>Drop Off Information:</h2></td>';
                $html .= '</tr>';
                $html .= '<tr>';
                $html .= '<td valign="top" class="text">Street:</td>';
                $html .= '<td valign="top" colspan="2">' . $dstreet . '</td>';
                $html .= '</tr>';
                $html .= '<tr>';
                // $html .= '<td valign="top" class="text">City:</td>';
                // $city = $db->GetOne("select name from " . DB_TABLE_PREFIX . "destinations where id ='" . $city . "'");
                // $html .= '<td valign="top" colspan="2">' . $city2 . '</td>';
                // $html .= '</tr>';
                // $html .= '<tr>';
                // $html .= '<td valign="top" class="text">State:</td>';
                // $html .= '<td valign="top" colspan="2">' . $state2 . '</td>';
                // $html .= '</tr>';
                // $html .= '<tr>';
                // $html .= '<td valign="top" class="text">Zip:</td>';
                // $html .= '<td valign="top" colspan="2">' . $zip2 . '</td>';
                // $html .= '</tr>';
            }

            $additionalArray = unserialize($additional);

            if (!empty($additionalArray)) {
                $html .= '<tr>';
                $html .= '<td valign="top" colspan="2"><h2>Additional Services:</h2></td>';
                $html .= '</tr>';
                foreach ($additionalArray as $key => $row) {
                    $doc_res_pricing_sql = "SELECT * FROM doc_res_pricing WHERE pricing_id = {$key}";
                    $res_pricing = $db->GetRow($doc_res_pricing_sql);
                    extract($res_pricing);
					
					if($pricing_type == 1) $sym = $pricing_price . "% of Total Cost Inclusive";
					else $sym = "$" . $pricing_price;

                    $html .= '<tr>';
                    $html .= '<td valign="top" class="text">' . $pricing_name . ':</td>';
                    $html .= '<td valign="top" colspan="2">' . $sym . '</td>';
                    $html .= '</tr>';
                }
            }

            $html .= '<tr>';
            $html .= '<td valign="top" class="text">Custom Additional Charges:</td>';
            $html .= '<td valign="top" colspan="2">$' . $_POST['CustomAdditionalCharges'] . '</td>';
            $html .= '</tr>';

            $html .= '<tr>';
            $html .= '<td valign="top" class="text">Gratuity:</td>';
            $html .= '<td valign="top" colspan="2">$' . $gratuityCharges . '</td>';
            $html .= '</tr>';

            $html .= '<tr>';
            $html .= '<td valign="top" class="text">Total Reservation Price:</td>';
            $html .= '<td valign="top" colspan="2">$' . $_POST['resPricetotal'] . '</td>';
            $html .= '</tr>';
            
            $html .= '<tr>';
            $html .= '<td valign="top" class="text">Discount</td>';
            $html .= '<td valign="top" colspan="2">$' . $_POST['discountPrice'] . '</td>';
            $html .= '</tr>';

            $html .= '<tr>';
            $html .= '<td valign="top" class="text">Total Cost Of Reservation:</td>';
            $html .= '<td valign="top" colspan="2">$' . $_POST['actualtotal'] . '</td>';
            $html .= '</tr>';

            $html .= '</tbody>';
            $html .= '</table>';

//            echo $html; exit;

            $_SESSION['emailhtml'] = $html;
            
            $_SESSION['reservation'] = $_POST;


            $html1 = '<p>Dear ' . $name . ', <br><br>We have received your reservation but, our reservation department will send you confirmation after checkout and charge your credit card. we appreciate your business.<br><br>Thanks</p>';
            SendMail($_SESSION['reservation']['email'], 'info@topctlimo.com', 'info@topctlimo.com', 'admin', 'NYCTLimo', $html1);


//            SendMail('umar.faiz.nvt@gmail.com', 'info@topctlimo.com', $_SESSION['reservation']['email'], 'admin', 'New Reservation - TOPCTLIMO', $html1 . $html);
            /*SendMail('info@topctlimo.com', 'info@topctlimo.com', $_SESSION['reservation']['email'], 'admin', 'New Reservation - TOPCTLIMO', $html1 . $html);
            SendMail('topctlimo20@gmail.com', 'info@topctlimo.com', $_SESSION['reservation']['email'], 'admin', 'New Reservation - TOPCTLIMO', $html1 . $html);
            SendMail('topctlimo@gmail.com', 'info@topctlimo.com', $_SESSION['reservation']['email'], 'admin', 'New Reservation - TOPCTLIMO', $html1 . $html);
            SendMail('shakil518@gmail.com', 'info@topctlimo.com', $_SESSION['reservation']['email'], 'admin', 'New Reservation - TOPCTLIMO', $html1 . $html);
            SendMail($_SESSION['reservation']['email'], 'info@topctlimo.com', 'info@topctlimo.com', 'admin', 'New Reservation - TOPCTLIMO', $html1 . $html);*/

            $datar['payment'] = 'Thanks for requesting a reservation. Please make a payment with secured STRIPE payment gateway.';

            echo json_encode($datar);
        } else if ($errors != '') {
            $datar['error'] = $errors;
            echo json_encode($datar);
        }
    }
}
?>
